<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210517163921 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE cu (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE meule_cu (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT DEFAULT NULL, ref VARCHAR(255) DEFAULT NULL, diametre INT DEFAULT NULL, hauteur INT DEFAULT NULL, grain VARCHAR(255) DEFAULT NULL, INDEX IDX_F5C8DC14670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_meule (id INT AUTO_INCREMENT NOT NULL, cu_id INT DEFAULT NULL, INDEX IDX_3DEDFE0DD51B60C (cu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type_meule_cu (id INT AUTO_INCREMENT NOT NULL, designation_tav VARCHAR(255) DEFAULT NULL, type_usinage VARCHAR(255) DEFAULT NULL, matiere VARCHAR(255) DEFAULT NULL, type_verre VARCHAR(255) DEFAULT NULL, stock_mini INT DEFAULT NULL, stock_reel INT DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE meule_cu ADD CONSTRAINT FK_F5C8DC14670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE type_meule ADD CONSTRAINT FK_3DEDFE0DD51B60C FOREIGN KEY (cu_id) REFERENCES cu (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE type_meule DROP FOREIGN KEY FK_3DEDFE0DD51B60C');
        $this->addSql('DROP TABLE cu');
        $this->addSql('DROP TABLE meule_cu');
        $this->addSql('DROP TABLE type_meule');
        $this->addSql('DROP TABLE type_meule_cu');
    }
}
