<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20181011092535 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SEQUENCE game_events_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE game_events (id INT NOT NULL, game_id INT NOT NULL, team_id INT NOT NULL, type VARCHAR(50) NOT NULL, player_id INT NOT NULL, period INT NOT NULL, time VARCHAR(255) NOT NULL, score INT NOT NULL, data JSON NOT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_2EB2FA82E48FD905 ON game_events (game_id)');
        $this->addSql('CREATE INDEX IDX_2EB2FA82296CD8AE ON game_events (team_id)');
        $this->addSql('COMMENT ON COLUMN game_events.data IS \'(DC2Type:json_document)\'');
        $this->addSql('ALTER TABLE game_events ADD CONSTRAINT FK_2EB2FA82E48FD905 FOREIGN KEY (game_id) REFERENCES games (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE game_events ADD CONSTRAINT FK_2EB2FA82296CD8AE FOREIGN KEY (team_id) REFERENCES teams (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'postgresql', 'Migration can only be executed safely on \'postgresql\'.');

        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE game_events_seq CASCADE');
        $this->addSql('DROP TABLE game_events');
    }
}
