<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210503185725 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE meules_recti_machine');
        $this->addSql('ALTER TABLE meules_recti DROP FOREIGN KEY FK_4489D73DDD842E46');
        $this->addSql('DROP INDEX IDX_4489D73DDD842E46 ON meules_recti');
        $this->addSql('ALTER TABLE meules_recti DROP position_id');
        $this->addSql('ALTER TABLE position ADD meules_recti_id INT DEFAULT NULL, CHANGE machine_id machine_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE position ADD CONSTRAINT FK_462CE4F510EFDBEB FOREIGN KEY (meules_recti_id) REFERENCES meules_recti (id)');
        $this->addSql('CREATE INDEX IDX_462CE4F510EFDBEB ON position (meules_recti_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE meules_recti_machine (meules_recti_id INT NOT NULL, machine_id INT NOT NULL, INDEX IDX_852DFE0710EFDBEB (meules_recti_id), INDEX IDX_852DFE07F6B75B26 (machine_id), PRIMARY KEY(meules_recti_id, machine_id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE meules_recti_machine ADD CONSTRAINT FK_852DFE0710EFDBEB FOREIGN KEY (meules_recti_id) REFERENCES meules_recti (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meules_recti_machine ADD CONSTRAINT FK_852DFE07F6B75B26 FOREIGN KEY (machine_id) REFERENCES machine (id) ON UPDATE NO ACTION ON DELETE CASCADE');
        $this->addSql('ALTER TABLE meules_recti ADD position_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE meules_recti ADD CONSTRAINT FK_4489D73DDD842E46 FOREIGN KEY (position_id) REFERENCES position (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('CREATE INDEX IDX_4489D73DDD842E46 ON meules_recti (position_id)');
        $this->addSql('ALTER TABLE position DROP FOREIGN KEY FK_462CE4F510EFDBEB');
        $this->addSql('DROP INDEX IDX_462CE4F510EFDBEB ON position');
        $this->addSql('ALTER TABLE position DROP meules_recti_id, CHANGE machine_id machine_id INT NOT NULL');
    }
}
