<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200519113431 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519B3DA5256D');
        $this->addSql('ALTER TABLE room DROP FOREIGN KEY FK_729F519BCFC2A925');
        $this->addSql('CREATE TABLE kind (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) NOT NULL, additional_price DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('DROP TABLE image');
        $this->addSql('DROP TABLE sort');
        $this->addSql('DROP INDEX IDX_729F519B3DA5256D ON room');
        $this->addSql('DROP INDEX IDX_729F519BCFC2A925 ON room');
        $this->addSql('ALTER TABLE room ADD filename VARCHAR(255) NOT NULL, ADD location VARCHAR(255) NOT NULL, DROP sort_id_id, DROP image_id, CHANGE extra_id extra_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE user CHANGE roles roles JSON NOT NULL, CHANGE last_activity last_activity DATETIME DEFAULT NULL');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE image (id INT AUTO_INCREMENT NOT NULL, filename VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, title VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE sort (id INT AUTO_INCREMENT NOT NULL, description VARCHAR(255) CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`, additional_cost DOUBLE PRECISION NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE `utf8_unicode_ci` ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('DROP TABLE kind');
        $this->addSql('ALTER TABLE room ADD sort_id_id INT NOT NULL, ADD image_id INT NOT NULL, DROP filename, DROP location, CHANGE extra_id extra_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519B3DA5256D FOREIGN KEY (image_id) REFERENCES image (id)');
        $this->addSql('ALTER TABLE room ADD CONSTRAINT FK_729F519BCFC2A925 FOREIGN KEY (sort_id_id) REFERENCES sort (id)');
        $this->addSql('CREATE INDEX IDX_729F519B3DA5256D ON room (image_id)');
        $this->addSql('CREATE INDEX IDX_729F519BCFC2A925 ON room (sort_id_id)');
        $this->addSql('ALTER TABLE user CHANGE roles roles LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_bin`, CHANGE last_activity last_activity DATETIME DEFAULT \'NULL\'');
    }
}
