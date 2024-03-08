<?php
namespace App\Email;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;

class InvitationEmail
{
    public function createInvitationEmail(string $to): TemplatedEmail
    {
        return (new TemplatedEmail())
            ->from(new Address('no-reply@example.com', 'App Name'))
            ->to($to)
            ->subject('Invitation à rejoindre la classe')
            ->htmlTemplate('emails/invitation.html.twig')
            ->context([
                'expiration_date' => new \DateTime('+7 days'),
                // ... autres variables nécessaires pour le template
            ]);
    }
}
