<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230509083915 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE schedule CHANGE opening_noon opening_noon TIME NOT NULL, CHANGE closing_noon closing_noon TIME NOT NULL, CHANGE opening_evening opening_evening TIME NOT NULL, CHANGE closing_evening closing_evening TIME NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE schedule CHANGE opening_noon opening_noon DATETIME NOT NULL, CHANGE closing_noon closing_noon DATETIME NOT NULL, CHANGE opening_evening opening_evening DATETIME NOT NULL, CHANGE closing_evening closing_evening DATETIME NOT NULL');
    }
}
