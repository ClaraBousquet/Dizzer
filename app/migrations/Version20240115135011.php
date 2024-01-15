<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240115135011 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE playlist (id INT AUTO_INCREMENT NOT NULL, playlist_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist ADD music_id INT NOT NULL');
        $this->addSql('ALTER TABLE artist ADD CONSTRAINT FK_1599687399BBB13 FOREIGN KEY (music_id) REFERENCES music (id)');
        $this->addSql('CREATE INDEX IDX_1599687399BBB13 ON artist (music_id)');
        $this->addSql('ALTER TABLE music ADD playlist_id INT DEFAULT NULL, ADD type VARCHAR(255) NOT NULL');
        $this->addSql('ALTER TABLE music ADD CONSTRAINT FK_CD52224A6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id)');
        $this->addSql('CREATE INDEX IDX_CD52224A6BBD148 ON music (playlist_id)');
        $this->addSql('ALTER TABLE user ADD artist_id INT DEFAULT NULL, ADD is_active TINYINT(1) NOT NULL, ADD is_admin TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
        $this->addSql('CREATE INDEX IDX_8D93D649B7970CF8 ON user (artist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE music DROP FOREIGN KEY FK_CD52224A6BBD148');
        $this->addSql('DROP TABLE playlist');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B7970CF8');
        $this->addSql('DROP INDEX IDX_8D93D649B7970CF8 ON user');
        $this->addSql('ALTER TABLE user DROP artist_id, DROP is_active, DROP is_admin');
        $this->addSql('ALTER TABLE artist DROP FOREIGN KEY FK_1599687399BBB13');
        $this->addSql('DROP INDEX IDX_1599687399BBB13 ON artist');
        $this->addSql('ALTER TABLE artist DROP music_id');
        $this->addSql('DROP INDEX IDX_CD52224A6BBD148 ON music');
        $this->addSql('ALTER TABLE music DROP playlist_id, DROP type');
    }
}
