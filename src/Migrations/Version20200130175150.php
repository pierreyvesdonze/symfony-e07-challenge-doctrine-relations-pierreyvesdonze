<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200130175150 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE author ADD post_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE author ADD CONSTRAINT FK_BDAFD8C84B89032C FOREIGN KEY (post_id) REFERENCES post (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_BDAFD8C84B89032C ON author (post_id)');
        $this->addSql('ALTER TABLE review DROP INDEX IDX_794381C64B89032C, ADD UNIQUE INDEX UNIQ_794381C64B89032C (post_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE author DROP FOREIGN KEY FK_BDAFD8C84B89032C');
        $this->addSql('DROP INDEX UNIQ_BDAFD8C84B89032C ON author');
        $this->addSql('ALTER TABLE author DROP post_id');
        $this->addSql('ALTER TABLE review DROP INDEX UNIQ_794381C64B89032C, ADD INDEX IDX_794381C64B89032C (post_id)');
    }
}
