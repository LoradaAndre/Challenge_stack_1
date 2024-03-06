<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240306110341 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE cours_classe DROP FOREIGN KEY FK_E007AEFE8F5EA509');
        $this->addSql('ALTER TABLE cours_classe DROP FOREIGN KEY FK_E007AEFE7ECF78B0');
        $this->addSql('ALTER TABLE classe_cours DROP FOREIGN KEY FK_B4BDD8A48F5EA509');
        $this->addSql('ALTER TABLE classe_cours DROP FOREIGN KEY FK_B4BDD8A47ECF78B0');
        $this->addSql('DROP TABLE cours_classe');
        $this->addSql('DROP TABLE classe_cours');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cours_classe (cours_id INT NOT NULL, classe_id INT NOT NULL, INDEX IDX_E007AEFE7ECF78B0 (cours_id), INDEX IDX_E007AEFE8F5EA509 (classe_id), PRIMARY KEY(cours_id, classe_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE classe_cours (classe_id INT NOT NULL, cours_id INT NOT NULL, INDEX IDX_B4BDD8A48F5EA509 (classe_id), INDEX IDX_B4BDD8A47ECF78B0 (cours_id), PRIMARY KEY(classe_id, cours_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE cours_classe ADD CONSTRAINT FK_E007AEFE8F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE cours_classe ADD CONSTRAINT FK_E007AEFE7ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE classe_cours ADD CONSTRAINT FK_B4BDD8A48F5EA509 FOREIGN KEY (classe_id) REFERENCES classe (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE classe_cours ADD CONSTRAINT FK_B4BDD8A47ECF78B0 FOREIGN KEY (cours_id) REFERENCES cours (id) ON UPDATE NO ACTION ON DELETE CASCADE');
    }
}
