<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210706125639 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consumption (id INT AUTO_INCREMENT NOT NULL, provider_id INT DEFAULT NULL, position_id INT DEFAULT NULL, machine_number VARCHAR(255) DEFAULT NULL, machine_side VARCHAR(255) DEFAULT NULL, linear_meters INT DEFAULT NULL, date DATE NOT NULL, ref VARCHAR(255) NOT NULL, INDEX IDX_2CFF2DF9A53A8AA (provider_id), INDEX IDX_2CFF2DF9DD842E46 (position_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE consumption ADD CONSTRAINT FK_2CFF2DF9A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE consumption ADD CONSTRAINT FK_2CFF2DF9DD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE consumption');
    }
}
