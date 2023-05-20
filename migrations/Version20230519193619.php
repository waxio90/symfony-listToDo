<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230519193619 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE item_to_do ADD list_to_do_id INT NOT NULL');
        $this->addSql('ALTER TABLE item_to_do ADD CONSTRAINT FK_38EEF6702584DFB7 FOREIGN KEY (list_to_do_id) REFERENCES list_to_do (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('CREATE INDEX IDX_38EEF6702584DFB7 ON item_to_do (list_to_do_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE item_to_do DROP CONSTRAINT FK_38EEF6702584DFB7');
        $this->addSql('DROP INDEX IDX_38EEF6702584DFB7');
        $this->addSql('ALTER TABLE item_to_do DROP list_to_do_id');
    }
}
