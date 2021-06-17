<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210617072855 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cu_categories (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE wheels_cu ADD tav_name VARCHAR(255) DEFAULT NULL');
        $this->addSql('ALTER TABLE wheels_cu_type ADD cu_category_id INT DEFAULT NULL, DROP tavname');
        $this->addSql('ALTER TABLE wheels_cu_type ADD CONSTRAINT FK_E300A8B2B1F2F5D1 FOREIGN KEY (cu_category_id) REFERENCES cu_categories (id)');
        $this->addSql('CREATE INDEX IDX_E300A8B2B1F2F5D1 ON wheels_cu_type (cu_category_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wheels_cu_type DROP FOREIGN KEY FK_E300A8B2B1F2F5D1');
        $this->addSql('DROP TABLE cu_categories');
        $this->addSql('ALTER TABLE wheels_cu DROP tav_name');
        $this->addSql('DROP INDEX IDX_E300A8B2B1F2F5D1 ON wheels_cu_type');
        $this->addSql('ALTER TABLE wheels_cu_type ADD tavname VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP cu_category_id');
    }
}
