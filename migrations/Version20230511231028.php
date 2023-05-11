<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511231028 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picdishes DROP FOREIGN KEY FK_8ADF486D642B8210');
        $this->addSql('ALTER TABLE picdishes ADD CONSTRAINT FK_8ADF486D642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picdishes DROP FOREIGN KEY FK_8ADF486D642B8210');
        $this->addSql('ALTER TABLE picdishes ADD CONSTRAINT FK_8ADF486D642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id) ON DELETE CASCADE');
    }
}
