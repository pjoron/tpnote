<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403131807 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE lieu ADD appartement_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE lieu ADD CONSTRAINT FK_2F577D59E1729BBA FOREIGN KEY (appartement_id) REFERENCES appartement (id)');
        $this->addSql('CREATE INDEX IDX_2F577D59E1729BBA ON lieu (appartement_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE lieu DROP FOREIGN KEY FK_2F577D59E1729BBA');
        $this->addSql('DROP INDEX IDX_2F577D59E1729BBA ON lieu');
        $this->addSql('ALTER TABLE lieu DROP appartement_id');
    }
}
