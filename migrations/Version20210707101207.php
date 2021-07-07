<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210707101207 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cu_consumption (id INT AUTO_INCREMENT NOT NULL, provider_id INT DEFAULT NULL, wheels_cu_type_id INT DEFAULT NULL, linear_meters INT DEFAULT NULL, date DATE NOT NULL, ref VARCHAR(255) NOT NULL, INDEX IDX_8F4B45CAA53A8AA (provider_id), INDEX IDX_8F4B45CAC645D94C (wheels_cu_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE cu_consumption ADD CONSTRAINT FK_8F4B45CAA53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE cu_consumption ADD CONSTRAINT FK_8F4B45CAC645D94C FOREIGN KEY (wheels_cu_type_id) REFERENCES wheels_cu_type (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE cu_consumption');
    }
}
