<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210419133028 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE machine (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meules_recti (id INT AUTO_INCREMENT NOT NULL, ref VARCHAR(255) DEFAULT NULL, designation_tav VARCHAR(255) NOT NULL, grain VARCHAR(255) DEFAULT NULL, diametre INT NOT NULL, hauteur INT DEFAULT NULL, stock INT NOT NULL, stock_mini INT NOT NULL, position LONGTEXT DEFAULT NULL COMMENT \'(DC2Type:array)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meules_recti_machine (meules_recti_id INT NOT NULL, machine_id INT NOT NULL, INDEX IDX_852DFE0710EFDBEB (meules_recti_id), INDEX IDX_852DFE07F6B75B26 (machine_id), PRIMARY KEY(meules_recti_id, machine_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meules_recti_machine ADD CONSTRAINT FK_852DFE0710EFDBEB FOREIGN KEY (meules_recti_id) REFERENCES meules_recti (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meules_recti_machine ADD CONSTRAINT FK_852DFE07F6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meules_recti_machine DROP FOREIGN KEY FK_852DFE07F6B75B26');
        $this->addSql('ALTER TABLE meules_recti_machine DROP FOREIGN KEY FK_852DFE0710EFDBEB');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE machine');
        $this->addSql('DROP TABLE meules_recti');
        $this->addSql('DROP TABLE meules_recti_machine');
    }
}
