<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210722085155 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE position CHANGE name name VARCHAR(255) NOT NULL, CHANGE stock_mini stock_mini INT NOT NULL');
        $this->addSql('ALTER TABLE user ADD email VARCHAR(255) DEFAULT NULL, ADD is_notifiable TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE position CHANGE name name VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, CHANGE stock_mini stock_mini INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user DROP email, DROP is_notifiable');
    }
}
