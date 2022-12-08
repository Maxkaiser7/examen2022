<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221208182938 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chansons ADD genres_id INT NOT NULL, ADD genre VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE chansons ADD CONSTRAINT FK_6EC68AA06A3B2603 FOREIGN KEY (genres_id) REFERENCES genres (id)');
        $this->addSql('CREATE INDEX IDX_6EC68AA06A3B2603 ON chansons (genres_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE chansons DROP FOREIGN KEY FK_6EC68AA06A3B2603');
        $this->addSql('DROP INDEX IDX_6EC68AA06A3B2603 ON chansons');
        $this->addSql('ALTER TABLE chansons DROP genres_id, DROP genre');
    }
}
