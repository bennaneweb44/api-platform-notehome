<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20221008195342 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE category (id INT AUTO_INCREMENT NOT NULL, nom VARCHAR(255) NOT NULL, couleur VARCHAR(255) NOT NULL, icone VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE element (id INT AUTO_INCREMENT NOT NULL, note_id INT DEFAULT NULL, rayon_id INT DEFAULT NULL, nom VARCHAR(255) NOT NULL, photo VARCHAR(255) DEFAULT NULL, barre TINYINT(1) NOT NULL, INDEX IDX_41405E3926ED0855 (note_id), INDEX IDX_41405E39D3202E52 (rayon_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE note (id INT AUTO_INCREMENT NOT NULL, user_id INT DEFAULT NULL, category_id INT DEFAULT NULL, title VARCHAR(255) NOT NULL, content LONGTEXT DEFAULT NULL, type SMALLINT NOT NULL, INDEX IDX_CFBDFA14A76ED395 (user_id), INDEX IDX_CFBDFA1412469DE2 (category_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rayon (id INT AUTO_INCREMENT NOT NULL, note_id INT NOT NULL, nom VARCHAR(255) NOT NULL, INDEX IDX_D5E5BC3C26ED0855 (note_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE share (id INT AUTO_INCREMENT NOT NULL, user_1_id INT NOT NULL, user_2_id INT NOT NULL, note_id INT NOT NULL, updated_by_id INT NOT NULL, updated_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', seen TINYINT(1) NOT NULL, INDEX IDX_EF069D5A8A521033 (user_1_id), INDEX IDX_EF069D5A98E7BFDD (user_2_id), INDEX IDX_EF069D5A26ED0855 (note_id), INDEX IDX_EF069D5A896DBBDE (updated_by_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user (id INT AUTO_INCREMENT NOT NULL, email VARCHAR(180) NOT NULL, roles JSON NOT NULL, password VARCHAR(255) NOT NULL, username VARCHAR(255) NOT NULL, avatar VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_8D93D649F85E0677 (username), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE element ADD CONSTRAINT FK_41405E3926ED0855 FOREIGN KEY (note_id) REFERENCES note (id)');
        $this->addSql('ALTER TABLE element ADD CONSTRAINT FK_41405E39D3202E52 FOREIGN KEY (rayon_id) REFERENCES rayon (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA14A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE note ADD CONSTRAINT FK_CFBDFA1412469DE2 FOREIGN KEY (category_id) REFERENCES category (id)');
        $this->addSql('ALTER TABLE rayon ADD CONSTRAINT FK_D5E5BC3C26ED0855 FOREIGN KEY (note_id) REFERENCES note (id)');
        $this->addSql('ALTER TABLE share ADD CONSTRAINT FK_EF069D5A8A521033 FOREIGN KEY (user_1_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE share ADD CONSTRAINT FK_EF069D5A98E7BFDD FOREIGN KEY (user_2_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE share ADD CONSTRAINT FK_EF069D5A26ED0855 FOREIGN KEY (note_id) REFERENCES note (id)');
        $this->addSql('ALTER TABLE share ADD CONSTRAINT FK_EF069D5A896DBBDE FOREIGN KEY (updated_by_id) REFERENCES user (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA1412469DE2');
        $this->addSql('ALTER TABLE element DROP FOREIGN KEY FK_41405E3926ED0855');
        $this->addSql('ALTER TABLE rayon DROP FOREIGN KEY FK_D5E5BC3C26ED0855');
        $this->addSql('ALTER TABLE share DROP FOREIGN KEY FK_EF069D5A26ED0855');
        $this->addSql('ALTER TABLE element DROP FOREIGN KEY FK_41405E39D3202E52');
        $this->addSql('ALTER TABLE note DROP FOREIGN KEY FK_CFBDFA14A76ED395');
        $this->addSql('ALTER TABLE share DROP FOREIGN KEY FK_EF069D5A8A521033');
        $this->addSql('ALTER TABLE share DROP FOREIGN KEY FK_EF069D5A98E7BFDD');
        $this->addSql('ALTER TABLE share DROP FOREIGN KEY FK_EF069D5A896DBBDE');
        $this->addSql('DROP TABLE category');
        $this->addSql('DROP TABLE element');
        $this->addSql('DROP TABLE note');
        $this->addSql('DROP TABLE rayon');
        $this->addSql('DROP TABLE share');
        $this->addSql('DROP TABLE user');
    }
}
