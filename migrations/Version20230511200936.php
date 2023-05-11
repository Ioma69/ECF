<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230511200936 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dishes_menu DROP FOREIGN KEY FK_DE629E4ACCD7E912');
        $this->addSql('ALTER TABLE dishes_menu DROP FOREIGN KEY FK_DE629E4AA05DD37A');
        $this->addSql('DROP TABLE dishes_menu');
        $this->addSql('ALTER TABLE dishes DROP FOREIGN KEY FK_584DD35D642B8210');
        $this->addSql('ALTER TABLE dishes DROP FOREIGN KEY FK_584DD35DA21214B7');
        $this->addSql('DROP INDEX IDX_584DD35D642B8210 ON dishes');
        $this->addSql('DROP INDEX IDX_584DD35DA21214B7 ON dishes');
        $this->addSql('ALTER TABLE dishes DROP admin_id, DROP categories_id');
        $this->addSql('ALTER TABLE menu DROP FOREIGN KEY FK_7D053A93642B8210');
        $this->addSql('DROP INDEX IDX_7D053A93642B8210 ON menu');
        $this->addSql('ALTER TABLE menu DROP admin_id');
        $this->addSql('ALTER TABLE picdishes DROP FOREIGN KEY FK_8ADF486D642B8210');
        $this->addSql('DROP INDEX IDX_8ADF486D642B8210 ON picdishes');
        $this->addSql('ALTER TABLE picdishes DROP admin_id');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C84955A76ED395');
        $this->addSql('DROP INDEX IDX_42C84955A76ED395 ON reservation');
        $this->addSql('DROP INDEX IDX_42C8495570BEE6D ON reservation');
        $this->addSql('ALTER TABLE reservation DROP user_id, DROP visitor_id');
        $this->addSql('ALTER TABLE schedule DROP FOREIGN KEY FK_5A3811FB39118BDC');
        $this->addSql('DROP INDEX IDX_5A3811FB39118BDC ON schedule');
        $this->addSql('ALTER TABLE schedule DROP admin_schedule_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dishes_menu (dishes_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_DE629E4AA05DD37A (dishes_id), INDEX IDX_DE629E4ACCD7E912 (menu_id), PRIMARY KEY(dishes_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE dishes_menu ADD CONSTRAINT FK_DE629E4ACCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dishes_menu ADD CONSTRAINT FK_DE629E4AA05DD37A FOREIGN KEY (dishes_id) REFERENCES dishes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dishes ADD admin_id INT DEFAULT NULL, ADD categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dishes ADD CONSTRAINT FK_584DD35D642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('ALTER TABLE dishes ADD CONSTRAINT FK_584DD35DA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_584DD35D642B8210 ON dishes (admin_id)');
        $this->addSql('CREATE INDEX IDX_584DD35DA21214B7 ON dishes (categories_id)');
        $this->addSql('ALTER TABLE menu ADD admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE menu ADD CONSTRAINT FK_7D053A93642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_7D053A93642B8210 ON menu (admin_id)');
        $this->addSql('ALTER TABLE picdishes ADD admin_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE picdishes ADD CONSTRAINT FK_8ADF486D642B8210 FOREIGN KEY (admin_id) REFERENCES admin (id) ON DELETE CASCADE');
        $this->addSql('CREATE INDEX IDX_8ADF486D642B8210 ON picdishes (admin_id)');
        $this->addSql('ALTER TABLE reservation ADD user_id INT DEFAULT NULL, ADD visitor_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495570BEE6D FOREIGN KEY (visitor_id) REFERENCES visitor (id)');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C84955A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_42C84955A76ED395 ON reservation (user_id)');
        $this->addSql('CREATE INDEX IDX_42C8495570BEE6D ON reservation (visitor_id)');
        $this->addSql('ALTER TABLE schedule ADD admin_schedule_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE schedule ADD CONSTRAINT FK_5A3811FB39118BDC FOREIGN KEY (admin_schedule_id) REFERENCES admin (id)');
        $this->addSql('CREATE INDEX IDX_5A3811FB39118BDC ON schedule (admin_schedule_id)');
    }
}
