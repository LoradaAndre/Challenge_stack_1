<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240307151335 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant ADD CONSTRAINT FK_717E22E3F6B192E FOREIGN KEY (id_classe_id) REFERENCES classe (id)');
        $this->addSql('CREATE INDEX IDX_717E22E3F6B192E ON etudiant (id_classe_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE etudiant DROP FOREIGN KEY FK_717E22E3F6B192E');
        $this->addSql('DROP INDEX IDX_717E22E3F6B192E ON etudiant');
    }
}
