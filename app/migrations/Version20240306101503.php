<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240306101503 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE formateur_organisme DROP FOREIGN KEY FK_CF0BFF845DDD38F5');
        $this->addSql('ALTER TABLE formateur_organisme DROP FOREIGN KEY FK_CF0BFF84155D8F51');
        $this->addSql('DROP TABLE formateur_organisme');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3369CFA23');
        $this->addSql('ALTER TABLE utilisateur DROP FOREIGN KEY FK_1D1C63B3C5F87C54');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3369CFA23 ON utilisateur');
        $this->addSql('DROP INDEX UNIQ_1D1C63B3C5F87C54 ON utilisateur');
        $this->addSql('ALTER TABLE utilisateur DROP id_etudiant_id, DROP id_formateur_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE formateur_organisme (formateur_id INT NOT NULL, organisme_id INT NOT NULL, INDEX IDX_CF0BFF84155D8F51 (formateur_id), INDEX IDX_CF0BFF845DDD38F5 (organisme_id), PRIMARY KEY(formateur_id, organisme_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE formateur_organisme ADD CONSTRAINT FK_CF0BFF845DDD38F5 FOREIGN KEY (organisme_id) REFERENCES organisme (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE formateur_organisme ADD CONSTRAINT FK_CF0BFF84155D8F51 FOREIGN KEY (formateur_id) REFERENCES formateur (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE utilisateur ADD id_etudiant_id INT DEFAULT NULL, ADD id_formateur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3369CFA23 FOREIGN KEY (id_formateur_id) REFERENCES formateur (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE utilisateur ADD CONSTRAINT FK_1D1C63B3C5F87C54 FOREIGN KEY (id_etudiant_id) REFERENCES etudiant (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3369CFA23 ON utilisateur (id_formateur_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1D1C63B3C5F87C54 ON utilisateur (id_etudiant_id)');
    }
}
