<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230412201500 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'creating Admin table';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE picdishes ADD admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE picdishes ADD CONSTRAINT FK_8ADF486D642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_8ADF486D642B8210 ON picdishes (admin_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE picdishes DROP FOREIGN KEY FK_8ADF486D642B8210');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP INDEX IDX_8ADF486D642B8210 ON picdishes');
        $this->addSql('ALTER TABLE picdishes DROP admin_id');
    }
}
