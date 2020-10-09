<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20201008212345 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE migrations');
        $this->addSql('DROP TABLE password_resets');
        $this->addSql('ALTER TABLE articles CHANGE rayon_id rayon_id INT UNSIGNED DEFAULT NULL, CHANGE modif_id modif_id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE articles_notes CHANGE article_id article_id INT UNSIGNED DEFAULT NULL, CHANGE note_id note_id INT UNSIGNED DEFAULT NULL, CHANGE modif_id modif_id INT UNSIGNED NOT NULL, CHANGE barre barre INT UNSIGNED NOT NULL, CHANGE position position INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE notes CHANGE categorie_id categorie_id INT UNSIGNED DEFAULT NULL, CHANGE user_id user_id INT UNSIGNED DEFAULT NULL, CHANGE modif_id modif_id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE rayons CHANGE user_id user_id INT UNSIGNED DEFAULT NULL, CHANGE categorie_id categorie_id INT UNSIGNED DEFAULT NULL, CHANGE modif_id modif_id INT UNSIGNED NOT NULL');
        $this->addSql('ALTER TABLE rayons_infos CHANGE rayon_id rayon_id INT NOT NULL, CHANGE note_id note_id INT NOT NULL, CHANGE user_id user_id INT NOT NULL, CHANGE modif_id modif_id INT NOT NULL, CHANGE checked checked TINYINT(1) NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE admin admin TINYINT(1) NOT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE migrations (id INT UNSIGNED AUTO_INCREMENT NOT NULL, migration VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, batch INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE password_resets (email VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, token VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL, PRIMARY KEY(email)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE user');
        $this->addSql('ALTER TABLE articles CHANGE rayon_id rayon_id INT UNSIGNED NOT NULL, CHANGE modif_id modif_id INT UNSIGNED DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE articles_notes CHANGE article_id article_id INT UNSIGNED NOT NULL, CHANGE note_id note_id INT UNSIGNED NOT NULL, CHANGE modif_id modif_id INT UNSIGNED DEFAULT 0 NOT NULL, CHANGE barre barre INT UNSIGNED DEFAULT 0 NOT NULL, CHANGE position position INT UNSIGNED DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE notes CHANGE categorie_id categorie_id INT UNSIGNED NOT NULL, CHANGE user_id user_id INT UNSIGNED NOT NULL, CHANGE modif_id modif_id INT UNSIGNED DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE rayons CHANGE categorie_id categorie_id INT UNSIGNED NOT NULL, CHANGE user_id user_id INT UNSIGNED NOT NULL, CHANGE modif_id modif_id INT UNSIGNED DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE rayons_infos CHANGE rayon_id rayon_id INT DEFAULT 0 NOT NULL, CHANGE note_id note_id INT DEFAULT 0 NOT NULL, CHANGE user_id user_id INT DEFAULT 0 NOT NULL, CHANGE modif_id modif_id INT DEFAULT 0 NOT NULL, CHANGE checked checked TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE users CHANGE admin admin TINYINT(1) DEFAULT \'0\' NOT NULL');
    }
}
