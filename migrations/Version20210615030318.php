<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210615030318 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meule_cu DROP FOREIGN KEY FK_F5C8DC14670C757F');
        $this->addSql('ALTER TABLE meules_recti DROP FOREIGN KEY FK_4489D73D670C757F');
        $this->addSql('ALTER TABLE position DROP FOREIGN KEY FK_462CE4F5F6B75B26');
        $this->addSql('ALTER TABLE meule_cu DROP FOREIGN KEY FK_F5C8DC148E45D969');
        $this->addSql('CREATE TABLE provider (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE recti_machine (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_A71697E15E237E06 (name), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wheels_cu (id INT AUTO_INCREMENT NOT NULL, provider_id INT DEFAULT NULL, wheels_cu_type_id INT DEFAULT NULL, ref VARCHAR(255) DEFAULT NULL, diameter INT DEFAULT NULL, height INT DEFAULT NULL, grain VARCHAR(255) DEFAULT NULL, stock INT DEFAULT NULL, INDEX IDX_DC65BD73A53A8AA (provider_id), INDEX IDX_DC65BD73C645D94C (wheels_cu_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wheels_cu_type (id INT AUTO_INCREMENT NOT NULL, cu_id INT DEFAULT NULL, tavname VARCHAR(255) DEFAULT NULL, wheels_type VARCHAR(255) DEFAULT NULL, matters VARCHAR(255) DEFAULT NULL, typical VARCHAR(255) DEFAULT NULL, stock_mini INT DEFAULT NULL, stock_real INT DEFAULT NULL, total_not_delivered INT DEFAULT NULL, INDEX IDX_E300A8B2DD51B60C (cu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE wheels_recti_machine (id INT AUTO_INCREMENT NOT NULL, provider_id INT DEFAULT NULL, position_id INT DEFAULT NULL, ref VARCHAR(255) DEFAULT NULL, tavname VARCHAR(255) NOT NULL, grain VARCHAR(255) DEFAULT NULL, diameter INT NOT NULL, height INT DEFAULT NULL, stock INT NOT NULL, not_delivered INT DEFAULT NULL, INDEX IDX_97BBB338A53A8AA (provider_id), INDEX IDX_97BBB338DD842E46 (position_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE wheels_cu ADD CONSTRAINT FK_DC65BD73A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE wheels_cu ADD CONSTRAINT FK_DC65BD73C645D94C FOREIGN KEY (wheels_cu_type_id) REFERENCES wheels_cu_type (id)');
        $this->addSql('ALTER TABLE wheels_cu_type ADD CONSTRAINT FK_E300A8B2DD51B60C FOREIGN KEY (cu_id) REFERENCES cu (id)');
        $this->addSql('ALTER TABLE wheels_recti_machine ADD CONSTRAINT FK_97BBB338A53A8AA FOREIGN KEY (provider_id) REFERENCES provider (id)');
        $this->addSql('ALTER TABLE wheels_recti_machine ADD CONSTRAINT FK_97BBB338DD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('DROP TABLE fournisseur');
        $this->addSql('DROP TABLE machine');
        $this->addSql('DROP TABLE meule_cu');
        $this->addSql('DROP TABLE meules_recti');
        $this->addSql('DROP TABLE type_meule_cu');
        $this->addSql('DROP INDEX IDX_462CE4F5F6B75B26 ON position');
        $this->addSql('ALTER TABLE position ADD recti_machine_id INT DEFAULT NULL, ADD working VARCHAR(255) DEFAULT NULL, ADD matters VARCHAR(255) DEFAULT NULL, ADD stock_real INT DEFAULT NULL, ADD total_not_delivered INT DEFAULT NULL, DROP machine_id, DROP usinage, DROP matiere, DROP stock_reel, DROP non_livre');
        $this->addSql('ALTER TABLE position ADD CONSTRAINT FK_462CE4F54B5D68C FOREIGN KEY (recti_machine_id) REFERENCES recti_machine (id)');
        $this->addSql('CREATE INDEX IDX_462CE4F54B5D68C ON position (recti_machine_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE wheels_cu DROP FOREIGN KEY FK_DC65BD73A53A8AA');
        $this->addSql('ALTER TABLE wheels_recti_machine DROP FOREIGN KEY FK_97BBB338A53A8AA');
        $this->addSql('ALTER TABLE position DROP FOREIGN KEY FK_462CE4F54B5D68C');
        $this->addSql('ALTER TABLE wheels_cu DROP FOREIGN KEY FK_DC65BD73C645D94C');
        $this->addSql('CREATE TABLE fournisseur (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE machine (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE meule_cu (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT DEFAULT NULL, type_meule_cu_id INT DEFAULT NULL, ref VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, diametre INT DEFAULT NULL, hauteur INT DEFAULT NULL, grain VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, stock INT DEFAULT NULL, INDEX IDX_F5C8DC148E45D969 (type_meule_cu_id), INDEX IDX_F5C8DC14670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE meules_recti (id INT AUTO_INCREMENT NOT NULL, fournisseur_id INT DEFAULT NULL, position_id INT DEFAULT NULL, ref VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, designation_tav VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, grain VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, diametre INT NOT NULL, hauteur INT DEFAULT NULL, stock INT NOT NULL, non_livres INT DEFAULT NULL, INDEX IDX_4489D73DDD842E46 (position_id), INDEX IDX_4489D73D670C757F (fournisseur_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE type_meule_cu (id INT AUTO_INCREMENT NOT NULL, cu_id INT DEFAULT NULL, designation_tav VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, type_meule VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, matiere VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, typical VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, stock_mini INT DEFAULT NULL, stock_reel INT DEFAULT NULL, non_livrees INT DEFAULT NULL, INDEX IDX_3837FBE8DD51B60C (cu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE meule_cu ADD CONSTRAINT FK_F5C8DC14670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE meule_cu ADD CONSTRAINT FK_F5C8DC148E45D969 FOREIGN KEY (type_meule_cu_id) REFERENCES type_meule_cu (id)');
        $this->addSql('ALTER TABLE meules_recti ADD CONSTRAINT FK_4489D73D670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('ALTER TABLE meules_recti ADD CONSTRAINT FK_4489D73DDD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('ALTER TABLE type_meule_cu ADD CONSTRAINT FK_3837FBE8DD51B60C FOREIGN KEY (cu_id) REFERENCES cu (id)');
        $this->addSql('DROP TABLE provider');
        $this->addSql('DROP TABLE recti_machine');
        $this->addSql('DROP TABLE wheels_cu');
        $this->addSql('DROP TABLE wheels_cu_type');
        $this->addSql('DROP TABLE wheels_recti_machine');
        $this->addSql('DROP INDEX IDX_462CE4F54B5D68C ON position');
        $this->addSql('ALTER TABLE position ADD machine_id INT DEFAULT NULL, ADD usinage VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD matiere VARCHAR(255) CHARACTER SET utf8mb4 DEFAULT NULL COLLATE `utf8mb4_unicode_ci`, ADD stock_reel INT DEFAULT NULL, ADD non_livre INT DEFAULT NULL, DROP recti_machine_id, DROP working, DROP matters, DROP stock_real, DROP total_not_delivered');
        $this->addSql('ALTER TABLE position ADD CONSTRAINT FK_462CE4F5F6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id)');
        $this->addSql('CREATE INDEX IDX_462CE4F5F6B75B26 ON position (machine_id)');
    }
}
