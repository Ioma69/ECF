<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230508150727 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, reservation_user_id INT NOT NULL, reservation_visitor_id INT NOT NULL, flatware INT NOT NULL, reservation_date DATETIME NOT NULL, reservation_hour DATETIME NOT NULL, allergy VARCHAR(255) NOT NULL, INDEX IDX_42C84955C0FB6810 (reservation_user_id), INDEX IDX_42C8495567A127D9 (reservation_visitor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visitor (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955C0FB6810 FOREIGN KEY (reservation_user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495567A127D9 FOREIGN KEY (reservation_visitor_id) REFERENCES visitor (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955C0FB6810');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495567A127D9');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE visitor');
    }
}
