<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210420205155 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE machine ADD position_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE machine ADD CONSTRAINT FK_1505DF84DD842E46 FOREIGN KEY (position_id) REFERENCES position (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_1505DF84DD842E46 ON machine (position_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE machine DROP FOREIGN KEY FK_1505DF84DD842E46');
        $this->addSql('DROP INDEX UNIQ_1505DF84DD842E46 ON machine');
        $this->addSql('ALTER TABLE machine DROP position_id');
    }
}
