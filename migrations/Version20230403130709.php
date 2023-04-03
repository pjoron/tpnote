<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20230403130709 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE critere_appartement (critere_id INT NOT NULL, appartement_id INT NOT NULL, INDEX IDX_FAC02AAD9E5F45AB (critere_id), INDEX IDX_FAC02AADE1729BBA (appartement_id), PRIMARY KEY(critere_id, appartement_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE critere_appartement ADD CONSTRAINT FK_FAC02AAD9E5F45AB FOREIGN KEY (critere_id) REFERENCES critere (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE critere_appartement ADD CONSTRAINT FK_FAC02AADE1729BBA FOREIGN KEY (appartement_id) REFERENCES appartement (id) ON DELETE CASCADE');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE appartement ADD lieu_id INT DEFAULT NULL, DROP titre, DROP description, DROP lien_image, DROP prix');
        $this->addSql('ALTER TABLE appartement ADD CONSTRAINT FK_71A6BD8D6AB213CC FOREIGN KEY (lieu_id) REFERENCES lieu (id)');
        $this->addSql('CREATE INDEX IDX_71A6BD8D6AB213CC ON appartement (lieu_id)');
        $this->addSql('ALTER TABLE lieu CHANGE codepostal codepostal VARCHAR(5) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(180) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, roles JSON NOT NULL, password VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, prenom VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, UNIQUE INDEX UNIQ_8D93D6496C6E55B5 (nom), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE critere_appartement DROP FOREIGN KEY FK_FAC02AAD9E5F45AB');
        $this->addSql('ALTER TABLE critere_appartement DROP FOREIGN KEY FK_FAC02AADE1729BBA');
        $this->addSql('DROP TABLE critere_appartement');
        $this->addSql('ALTER TABLE appartement DROP FOREIGN KEY FK_71A6BD8D6AB213CC');
        $this->addSql('DROP INDEX IDX_71A6BD8D6AB213CC ON appartement');
        $this->addSql('ALTER TABLE appartement ADD titre VARCHAR(150) NOT NULL, ADD description LONGTEXT NOT NULL, ADD lien_image VARCHAR(255) NOT NULL, ADD prix DOUBLE PRECISION NOT NULL, DROP lieu_id');
        $this->addSql('ALTER TABLE lieu CHANGE codepostal codepostal VARCHAR(255) NOT NULL');
    }
}
