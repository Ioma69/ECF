<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230512004250 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE admin (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_880E0D76E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dishes (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, categories_id INT DEFAULT NULL, title VARCHAR(80) NOT NULL, description VARCHAR(255) NOT NULL, price INT NOT NULL, INDEX IDX_584DD35D642B8210 (admin_id), INDEX IDX_584DD35DA21214B7 (categories_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE dishes_menu (dishes_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_DE629E4AA05DD37A (dishes_id), INDEX IDX_DE629E4ACCD7E912 (menu_id), PRIMARY KEY(dishes_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE menu (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, menu_title VARCHAR(80) NOT NULL, description VARCHAR(255) NOT NULL, price INT NOT NULL, INDEX IDX_7D053A93642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE picdishes (id INT AUTO_INCREMENT NOT NULL, admin_id INT DEFAULT NULL, title VARCHAR(80) NOT NULL, image LONGTEXT NOT NULL, INDEX IDX_8ADF486D642B8210 (admin_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE reservation (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, visitor_id INT DEFAULT NULL, flatware INT NOT NULL, reservation_date DATE NOT NULL, reservation_hour TIME NOT NULL, allergy LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', INDEX IDX_42C84955A76ED395 (user_id), INDEX IDX_42C8495570BEE6D (visitor_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedule (id INT AUTO_INCREMENT NOT NULL, admin_schedule_id INT DEFAULT NULL, opening_noon TIME NOT NULL, closing_noon TIME NOT NULL, opening_evening TIME NOT NULL, closing_evening TIME NOT NULL, INDEX IDX_5A3811FB39118BDC (admin_schedule_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:json)\', password VARCHAR(255) NOT NULL, name VARCHAR(50) NOT NULL, firstname VARCHAR(50) NOT NULL, phone VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE visitor (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, phone VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dishes ADD CONSTRAINT FK_584DD35D642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE dishes ADD CONSTRAINT FK_584DD35DA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE dishes_menu ADD CONSTRAINT FK_DE629E4AA05DD37A FOREIGN KEY (dishes_id) REFERENCES dishes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dishes_menu ADD CONSTRAINT FK_DE629E4ACCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE picdishes ADD CONSTRAINT FK_8ADF486D642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495570BEE6D FOREIGN KEY (visitor_id) REFERENCES visitor (id)');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB39118BDC FOREIGN KEY (admin_schedule_id) REFERENCES admin (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dishes DROP FOREIGN KEY FK_584DD35D642B8210');
        $this->addSql('ALTER TABLE dishes DROP FOREIGN KEY FK_584DD35DA21214B7');
        $this->addSql('ALTER TABLE dishes_menu DROP FOREIGN KEY FK_DE629E4AA05DD37A');
        $this->addSql('ALTER TABLE dishes_menu DROP FOREIGN KEY FK_DE629E4ACCD7E912');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93642B8210');
        $this->addSql('ALTER TABLE picdishes DROP FOREIGN KEY FK_8ADF486D642B8210');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495570BEE6D');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB39118BDC');
        $this->addSql('DROP TABLE admin');
        $this->addSql('DROP TABLE categories');
        $this->addSql('DROP TABLE dishes');
        $this->addSql('DROP TABLE dishes_menu');
        $this->addSql('DROP TABLE menu');
        $this->addSql('DROP TABLE picdishes');
        $this->addSql('DROP TABLE reservation');
        $this->addSql('DROP TABLE schedule');
        $this->addSql('DROP TABLE user');
        $this->addSql('DROP TABLE visitor');
    }
}
