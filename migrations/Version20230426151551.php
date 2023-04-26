<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230426151551 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'add relations between entity dishes and entity categories';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dishes ADD categories_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE dishes ADD CONSTRAINT FK_584DD35DA21214B7 FOREIGN KEY (categories_id) REFERENCES categories (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_584DD35DA21214B7 ON dishes (categories_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE dishes DROP FOREIGN KEY FK_584DD35DA21214B7');
        $this->addSql('DROP INDEX UNIQ_584DD35DA21214B7 ON dishes');
        $this->addSql('ALTER TABLE dishes DROP categories_id');
    }
}
