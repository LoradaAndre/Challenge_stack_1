<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240308103327 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE organisme_formateur DROP FOREIGN KEY FK_A41FD0085DDD38F5');
        $this->addSql('ALTER TABLE organisme_formateur DROP FOREIGN KEY FK_A41FD008155D8F51');
        $this->addSql('ALTER TABLE classe_cours DROP FOREIGN KEY FK_B4BDD8A48F5EA509');
        $this->addSql('ALTER TABLE classe_cours DROP FOREIGN KEY FK_B4BDD8A47ECF78B0');
        $this->addSql('DROP TABLE organisme_formateur');
        $this->addSql('DROP TABLE classe_cours');
        $this->addSql('ALTER TABLE etudiant ADD id_classe_id INT NOT NULL');
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3F6B192E FOREIGN KEY (id_classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_717E22E3F6B192E ON etudiant (id_classe_id)');
        $this->addSql('ALTER TABLE utilisateur CHANGE nom nom VARCHAR(255) DEFAULT NULL, CHANGE prenom prenom VARCHAR(255) DEFAULT NULL, CHANGE photo_profil photo_profil VARCHAR(255) DEFAULT NULL, CHANGE mot_de_passe mot_de_passe VARCHAR(255) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE organisme_formateur (organisme_id INT NOT NULL, formateur_id INT NOT NULL, INDEX IDX_A41FD0085DDD38F5 (organisme_id), INDEX IDX_A41FD008155D8F51 (formateur_id), PRIMARY KEY(organisme_id, formateur_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE classe_cours (classe_id INT NOT NULL, cours_id INT NOT NULL, INDEX IDX_B4BDD8A48F5EA509 (classe_id), INDEX IDX_B4BDD8A47ECF78B0 (cours_id), PRIMARY KEY(classe_id, cours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE organisme_formateur ADD CONSTRAINT FK_A41FD0085DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE organisme_formateur ADD CONSTRAINT FK_A41FD008155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe_cours ADD CONSTRAINT FK_B4BDD8A48F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe_cours ADD CONSTRAINT FK_B4BDD8A47ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3F6B192E');
        $this->addSql('DROP INDEX IDX_717E22E3F6B192E ON etudiant');
        $this->addSql('ALTER TABLE etudiant DROP id_classe_id');
        $this->addSql('ALTER TABLE utilisateur CHANGE nom nom VARCHAR(255) NOT NULL, CHANGE prenom prenom VARCHAR(255) NOT NULL, CHANGE photo_profil photo_profil VARCHAR(255) NOT NULL, CHANGE mot_de_passe mot_de_passe VARCHAR(255) DEFAULT NULL');
    }
}
