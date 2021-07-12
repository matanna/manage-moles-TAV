<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210518183400 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meule_cu ADD type_meule_cu_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE meule_cu ADD CONSTRAINT FK_F5C8DC148E45D969 FOREIGN KEY (type_meule_cu_id) REFERENCES type_meule_cu (id)');
        $this->addSql('CREATE INDEX IDX_F5C8DC148E45D969 ON meule_cu (type_meule_cu_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE meule_cu DROP FOREIGN KEY FK_F5C8DC148E45D969');
        $this->addSql('DROP INDEX IDX_F5C8DC148E45D969 ON meule_cu');
        $this->addSql('ALTER TABLE meule_cu DROP type_meule_cu_id');
    }
}
