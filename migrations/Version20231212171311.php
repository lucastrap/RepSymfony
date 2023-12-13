<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231212171311 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE artiste (id INT AUTO_INCREMENT NOT NULL, type_id INT NOT NULL, nom VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, date_naissance DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', lieu_naissance VARCHAR(255) NOT NULL, photo VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, INDEX IDX_9C07354FC54C8C93 (type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chanson (id INT AUTO_INCREMENT NOT NULL, titre VARCHAR(255) NOT NULL, date_sortie DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', genre VARCHAR(255) NOT NULL, langue VARCHAR(255) NOT NULL, photo_couverture VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE chanson_artiste (chanson_id INT NOT NULL, artiste_id INT NOT NULL, INDEX IDX_77F23BCD2D0460C5 (chanson_id), INDEX IDX_77F23BCD21D25844 (artiste_id), PRIMARY KEY(chanson_id, artiste_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE type (id INT AUTO_INCREMENT NOT NULL, type VARCHAR(255) NOT NULL, description VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artiste ADD CONSTRAINT FK_9C07354FC54C8C93 FOREIGN KEY (type_id) REFERENCES type (id)');
        $this->addSql('ALTER TABLE chanson_artiste ADD CONSTRAINT FK_77F23BCD2D0460C5 FOREIGN KEY (chanson_id) REFERENCES chanson (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE chanson_artiste ADD CONSTRAINT FK_77F23BCD21D25844 FOREIGN KEY (artiste_id) REFERENCES artiste (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artiste DROP FOREIGN KEY FK_9C07354FC54C8C93');
        $this->addSql('ALTER TABLE chanson_artiste DROP FOREIGN KEY FK_77F23BCD2D0460C5');
        $this->addSql('ALTER TABLE chanson_artiste DROP FOREIGN KEY FK_77F23BCD21D25844');
        $this->addSql('DROP TABLE artiste');
        $this->addSql('DROP TABLE chanson');
        $this->addSql('DROP TABLE chanson_artiste');
        $this->addSql('DROP TABLE type');
    }
}
