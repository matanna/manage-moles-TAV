<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210517164708 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE type_meule');
        $this->addSql('ALTER TABLE type_meule_cu ADD cu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE type_meule_cu ADD CONSTRAINT FK_3837FBE8DD51B60C FOREIGN KEY (cu_id) REFERENCES cu (id)');
        $this->addSql('CREATE INDEX IDX_3837FBE8DD51B60C ON type_meule_cu (cu_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE type_meule (id INT AUTO_INCREMENT NOT NULL, cu_id INT DEFAULT NULL, INDEX IDX_3DEDFE0DD51B60C (cu_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE type_meule ADD CONSTRAINT FK_3DEDFE0DD51B60C FOREIGN KEY (cu_id) REFERENCES cu (id) ON UPDATE NO ACTION ON DELETE NO ACTION');
        $this->addSql('ALTER TABLE type_meule_cu DROP FOREIGN KEY FK_3837FBE8DD51B60C');
        $this->addSql('DROP INDEX IDX_3837FBE8DD51B60C ON type_meule_cu');
        $this->addSql('ALTER TABLE type_meule_cu DROP cu_id');
    }
}
