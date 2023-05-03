<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230503120659 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dishes_menu (dishes_id INT NOT NULL, menu_id INT NOT NULL, INDEX IDX_DE629E4AA05DD37A (dishes_id), INDEX IDX_DE629E4ACCD7E912 (menu_id), PRIMARY KEY(dishes_id, menu_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE dishes_menu ADD CONSTRAINT FK_DE629E4AA05DD37A FOREIGN KEY (dishes_id) REFERENCES dishes (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE dishes_menu ADD CONSTRAINT FK_DE629E4ACCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE menu_dishes DROP FOREIGN KEY FK_8B0A8B85148EB0CB');
        $this->addSql('ALTER TABLE menu_dishes DROP FOREIGN KEY FK_8B0A8B85CCD7E912');
        $this->addSql('DROP TABLE menu_dishes');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE menu_dishes (menu_id INT NOT NULL, dish_id INT NOT NULL, INDEX IDX_8B0A8B85CCD7E912 (menu_id), INDEX IDX_8B0A8B85148EB0CB (dish_id), PRIMARY KEY(menu_id, dish_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE menu_dishes ADD CONSTRAINT FK_8B0A8B85148EB0CB FOREIGN KEY (dish_id) REFERENCES dishes (id)');
        $this->addSql('ALTER TABLE menu_dishes ADD CONSTRAINT FK_8B0A8B85CCD7E912 FOREIGN KEY (menu_id) REFERENCES menu (id)');
        $this->addSql('ALTER TABLE dishes_menu DROP FOREIGN KEY FK_DE629E4AA05DD37A');
        $this->addSql('ALTER TABLE dishes_menu DROP FOREIGN KEY FK_DE629E4ACCD7E912');
        $this->addSql('DROP TABLE dishes_menu');
    }
}
