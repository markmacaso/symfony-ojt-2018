<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181011050116 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE teams_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE games_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE teams (id INT NOT NULL, name VARCHAR(100) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE games (id INT NOT NULL, home_team_id INT NOT NULL, visitor_team_id INT NOT NULL, quarter INT NOT NULL, time VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FF232B319C4C13F6 ON games (home_team_id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_FF232B31EB7F4866 ON games (visitor_team_id)');
        $this->addSql('ALTER TABLE games ADD CONSTRAINT FK_FF232B319C4C13F6 FOREIGN KEY (home_team_id) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE games ADD CONSTRAINT FK_FF232B31EB7F4866 FOREIGN KEY (visitor_team_id) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE games DROP CONSTRAINT FK_FF232B319C4C13F6');
        $this->addSql('ALTER TABLE games DROP CONSTRAINT FK_FF232B31EB7F4866');
        $this->addSql('DROP SEQUENCE teams_seq CASCADE');
        $this->addSql('DROP SEQUENCE games_seq CASCADE');
        $this->addSql('DROP TABLE teams');
        $this->addSql('DROP TABLE games');
    }
}
