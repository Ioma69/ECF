<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230426142548 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add relations between entity admin and entity dishes';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dishes ADD admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dishes ADD CONSTRAINT FK_584DD35D642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_584DD35D642B8210 ON dishes (admin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dishes DROP FOREIGN KEY FK_584DD35D642B8210');
        $this->addSql('DROP INDEX IDX_584DD35D642B8210 ON dishes');
        $this->addSql('ALTER TABLE dishes DROP admin_id');
    }
}
