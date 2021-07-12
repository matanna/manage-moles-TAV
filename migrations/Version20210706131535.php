<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210706131535 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE recti_machine_consumption (id INT AUTO_INCREMENT NOT NULL, provider_id INT DEFAULT NULL, position_id INT DEFAULT NULL, machine_number VARCHAR(255) DEFAULT NULL, machine_side VARCHAR(255) DEFAULT NULL, linear_meters INT DEFAULT NULL, date DATE NOT NULL, ref VARCHAR(255) NOT NULL, INDEX IDX_FB2B2ADDA53A8AA (provider_id), INDEX IDX_FB2B2ADDDD842E46 (position_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE recti_machine_consumption ADD CONSTRAINT FK_FB2B2ADDA53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE recti_machine_consumption ADD CONSTRAINT FK_FB2B2ADDDD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('DROP TABLE consumption');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE consumption (id INT AUTO_INCREMENT NOT NULL, provider_id INT DEFAULT NULL, position_id INT DEFAULT NULL, machine_number VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, machine_side VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, linear_meters INT DEFAULT NULL, date DATE NOT NULL, ref VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, INDEX IDX_2CFF2DF9A53A8AA (provider_id), INDEX IDX_2CFF2DF9DD842E46 (position_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE consumption ADD CONSTRAINT FK_2CFF2DF9A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE consumption ADD CONSTRAINT FK_2CFF2DF9DD842E46 FOREIGN KEY (position_id) REFERENCES position (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('DROP TABLE recti_machine_consumption');
    }
}
