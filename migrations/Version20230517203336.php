<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230517203336 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dishes DROP FOREIGN KEY FK_584DD35DA21214B7');
        $this->addSql('ALTER TABLE dishes ADD CONSTRAINT FK_584DD35DA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495570BEE6D');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495570BEE6D FOREIGN KEY (visitor_id) REFERENCES visitor (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dishes DROP FOREIGN KEY FK_584DD35DA21214B7');
        $this->addSql('ALTER TABLE dishes ADD CONSTRAINT FK_584DD35DA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('ALTER TABLE reservation DROP FOREIGN KEY FK_42C8495570BEE6D');
        $this->addSql('ALTER TABLE reservation ADD CONSTRAINT FK_42C8495570BEE6D FOREIGN KEY (visitor_id) REFERENCES visitor (id)');
    }
}
