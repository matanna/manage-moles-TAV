<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210420093327 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meules_recti ADD fournisseur_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE meules_recti ADD CONSTRAINT FK_4489D73D670C757F FOREIGN KEY (fournisseur_id) REFERENCES fournisseur (id)');
        $this->addSql('CREATE INDEX IDX_4489D73D670C757F ON meules_recti (fournisseur_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meules_recti DROP FOREIGN KEY FK_4489D73D670C757F');
        $this->addSql('DROP INDEX IDX_4489D73D670C757F ON meules_recti');
        $this->addSql('ALTER TABLE meules_recti DROP fournisseur_id');
    }
}
