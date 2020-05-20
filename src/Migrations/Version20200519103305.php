<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200519103305 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE extra (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, additional_cost DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE room (id INT AUTO_INCREMENT NOT NULL, sort_id_id INT NOT NULL, extra_id INT DEFAULT NULL, image_id INT NOT NULL, price DOUBLE PRECISION NOT NULL, INDEX IDX_729F519BCFC2A925 (sort_id_id), INDEX IDX_729F519B2B959FC6 (extra_id), INDEX IDX_729F519B3DA5256D (image_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sort (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, additional_cost DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BCFC2A925 FOREIGN KEY (sort_id_id) REFERENCES sort (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B2B959FC6 FOREIGN KEY (extra_id) REFERENCES extra (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE last_activity last_activity DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B2B959FC6');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B3DA5256D');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519BCFC2A925');
        $this->addSql('DROP TABLE extra');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE room');
        $this->addSql('DROP TABLE sort');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE last_activity last_activity DATETIME DEFAULT \'NULL\'');
    }
}
