<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503101759 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meules_recti ADD position_id INT DEFAULT NULL, DROP position');
        $this->addSql('ALTER TABLE meules_recti ADD CONSTRAINT FK_4489D73DDD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('CREATE INDEX IDX_4489D73DDD842E46 ON meules_recti (position_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meules_recti DROP FOREIGN KEY FK_4489D73DDD842E46');
        $this->addSql('DROP INDEX IDX_4489D73DDD842E46 ON meules_recti');
        $this->addSql('ALTER TABLE meules_recti ADD position VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, DROP position_id');
    }
}
