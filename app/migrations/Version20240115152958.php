<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240115152958 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE album (id INT AUTO_INCREMENT NOT NULL, album_name VARCHAR(255) NOT NULL, album_artist VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, album_type VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist (id INT AUTO_INCREMENT NOT NULL, artist_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE artist_music (artist_id INT NOT NULL, music_id INT NOT NULL, INDEX IDX_AD5E1219B7970CF8 (artist_id), INDEX IDX_AD5E1219399BBB13 (music_id), PRIMARY KEY(artist_id, music_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE music (id INT AUTO_INCREMENT NOT NULL, playlist_id INT DEFAULT NULL, name VARCHAR(255) NOT NULL, type VARCHAR(255) NOT NULL, artists VARCHAR(255) NOT NULL, INDEX IDX_CD52224A6BBD148 (playlist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE playlist (id INT AUTO_INCREMENT NOT NULL, playlist_name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, artist_id INT DEFAULT NULL, user_name VARCHAR(255) NOT NULL, user_birthday DATE NOT NULL, user_account TINYINT(1) NOT NULL, is_active TINYINT(1) NOT NULL, is_admin TINYINT(1) NOT NULL, INDEX IDX_8D93D649B7970CF8 (artist_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE artist_music ADD CONSTRAINT FK_AD5E1219B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE artist_music ADD CONSTRAINT FK_AD5E1219399BBB13 FOREIGN KEY (music_id) REFERENCES music (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE music ADD CONSTRAINT FK_CD52224A6BBD148 FOREIGN KEY (playlist_id) REFERENCES playlist (id)');
        $this->addSql('ALTER TABLE user ADD CONSTRAINT FK_8D93D649B7970CF8 FOREIGN KEY (artist_id) REFERENCES artist (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE artist_music DROP FOREIGN KEY FK_AD5E1219B7970CF8');
        $this->addSql('ALTER TABLE artist_music DROP FOREIGN KEY FK_AD5E1219399BBB13');
        $this->addSql('ALTER TABLE music DROP FOREIGN KEY FK_CD52224A6BBD148');
        $this->addSql('ALTER TABLE user DROP FOREIGN KEY FK_8D93D649B7970CF8');
        $this->addSql('DROP TABLE album');
        $this->addSql('DROP TABLE artist');
        $this->addSql('DROP TABLE artist_music');
        $this->addSql('DROP TABLE music');
        $this->addSql('DROP TABLE playlist');
        $this->addSql('DROP TABLE user');
    }
}
