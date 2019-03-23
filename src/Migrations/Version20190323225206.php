<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190323225206 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE business (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, register_at DATETIME NOT NULL, sector VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE independent (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, sector VARCHAR(255) NOT NULL, register_at DATETIME NOT NULL, email VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_D2A94E98A76ED395 (user_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE independent ADD CONSTRAINT FK_D2A94E98A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE quotation ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE quotation ADD CONSTRAINT FK_474A8DB9A76ED395 FOREIGN KEY (user_id) REFERENCES fos_user (id)');
        $this->addSql('CREATE INDEX IDX_474A8DB9A76ED395 ON quotation (user_id)');
        $this->addSql('ALTER TABLE fos_user ADD business_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE fos_user ADD CONSTRAINT FK_957A6479A89DB457 FOREIGN KEY (business_id) REFERENCES business (id)');
        $this->addSql('CREATE INDEX IDX_957A6479A89DB457 ON fos_user (business_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE fos_user DROP FOREIGN KEY FK_957A6479A89DB457');
        $this->addSql('DROP TABLE business');
        $this->addSql('DROP TABLE independent');
        $this->addSql('DROP INDEX IDX_957A6479A89DB457 ON fos_user');
        $this->addSql('ALTER TABLE fos_user DROP business_id');
        $this->addSql('ALTER TABLE quotation DROP FOREIGN KEY FK_474A8DB9A76ED395');
        $this->addSql('DROP INDEX IDX_474A8DB9A76ED395 ON quotation');
        $this->addSql('ALTER TABLE quotation DROP user_id');
    }
}
