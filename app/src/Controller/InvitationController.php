<?php
// src/Controller/InvitationController.php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Utilisateur;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Mime\Email;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;


class InvitationController extends AbstractController
{
    /**
     * @Route("/inviter-eleve", name="invite_student")
     */
    #[Route('/inviter-eleve', name: 'invite_student', methods: ['GET', 'POST'])]
    public function invite(Request $request, MailerInterface $mailer, EntityManagerInterface $entityManager, Security $security, UserPasswordHasherInterface $passwordHasher, Environment $twig): Response
    {
        if ($request->isMethod('POST')) {
            $user = $security->getUser();
            $EmailFormateur = $user->getEmail();
            $emailAddress = $request->request->get('email');
            
            // Créer une nouvelle instance de l'entité User (ou votre entité élève)
            $newUser = new Utilisateur(); 
            $newUser->setEmail($emailAddress);
            $newUser->setNom("NOM");
            $newUser->setPrenom("PRENOM");
            $newUser->setPhotoProfil("PHOTO DE PROFIL");
            $newUser->setAdmin("0");
            $newUser->setStatut("etudiant"); // Assurez-vous que cette valeur n'est pas null
            // Générez un mot de passe aléatoire
            $randomPassword = bin2hex(random_bytes(4));

            // Hasher le mot de passe aléatoire
            $hashedPassword = $passwordHasher->hashPassword($newUser, $randomPassword);
            $newUser->setMotDePasse($hashedPassword);

            // Persister le nouvel utilisateur dans la base de données
            $entityManager->persist($newUser);
            $entityManager->flush();
            
            $email = (new TemplatedEmail())
                ->from($EmailFormateur)
                ->to($emailAddress)
                ->subject('Invitation à rejoindre la classe')
                ->html('<p>See Twig integration for better HTML integration!</p>')
                ->htmlTemplate('emails/invitation.html.twig')
                ->context([
                    'password' => $randomPassword,
                    'confirmation_url' => $this->generateUrl('app_login', [], UrlGeneratorInterface::ABSOLUTE_URL),
                ]);
                // // $mailer->send($email);

            // $email = (new Email())
            // ->from('hello@example.com')
            // ->to('you@example.com')
            // //->cc('cc@example.com')
            // //->bcc('bcc@example.com')
            // //->replyTo('fabien@example.com')
            // //->priority(Email::PRIORITY_HIGH)
            // ->subject('Time for Symfony Mailer!')
            // ->text('Sending emails is fun again!')
            // ->html('<p>See Twig integration for better HTML integration!</p>');

            // $mailer->send($email);
            try {
                $mailer->send($email);
                $this->addFlash('success', 'L\'invitation a été envoyée avec succès.');
            } catch (TransportExceptionInterface $e) {
                // some error prevented the email sending; display an
                // error message or try to resend the message
            }



            $this->addFlash('success', 'L\'invitation a été envoyée avec succès.');

            return $this->redirectToRoute('app_addEleves');
        }
    }
}
