<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210515084549 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE fighters (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, img LONGBLOB DEFAULT NULL, icon LONGBLOB DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE players (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, creation_date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE scores (id INT AUTO_INCREMENT NOT NULL, winner_id INT NOT NULL, looser_id INT NOT NULL, stage_id INT DEFAULT NULL, creation_date DATE NOT NULL, INDEX IDX_750375E5DFCD4B8 (winner_id), INDEX IDX_750375EAC391B62 (looser_id), INDEX IDX_750375E2298D193 (stage_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE selections (id INT AUTO_INCREMENT NOT NULL, player_id INT NOT NULL, fighter_id INT NOT NULL, INDEX IDX_32F2D7099E6F5DF (player_id), INDEX IDX_32F2D7034934341 (fighter_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stages (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, img LONGBLOB DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE scores ADD CONSTRAINT FK_750375E5DFCD4B8 FOREIGN KEY (winner_id) REFERENCES selections (id)');
        $this->addSql('ALTER TABLE scores ADD CONSTRAINT FK_750375EAC391B62 FOREIGN KEY (looser_id) REFERENCES selections (id)');
        $this->addSql('ALTER TABLE scores ADD CONSTRAINT FK_750375E2298D193 FOREIGN KEY (stage_id) REFERENCES stages (id)');
        $this->addSql('ALTER TABLE selections ADD CONSTRAINT FK_32F2D7099E6F5DF FOREIGN KEY (player_id) REFERENCES players (id)');
        $this->addSql('ALTER TABLE selections ADD CONSTRAINT FK_32F2D7034934341 FOREIGN KEY (fighter_id) REFERENCES fighters (id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE selections DROP FOREIGN KEY FK_32F2D7034934341');
        $this->addSql('ALTER TABLE selections DROP FOREIGN KEY FK_32F2D7099E6F5DF');
        $this->addSql('ALTER TABLE scores DROP FOREIGN KEY FK_750375E5DFCD4B8');
        $this->addSql('ALTER TABLE scores DROP FOREIGN KEY FK_750375EAC391B62');
        $this->addSql('ALTER TABLE scores DROP FOREIGN KEY FK_750375E2298D193');
        $this->addSql('DROP TABLE fighters');
        $this->addSql('DROP TABLE players');
        $this->addSql('DROP TABLE scores');
        $this->addSql('DROP TABLE selections');
        $this->addSql('DROP TABLE stages');
    }
}
