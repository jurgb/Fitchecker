<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160906151012 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE equipment');
        $this->addSql('DROP TABLE exercice_set');
        $this->addSql('DROP INDEX IDX_4E57311CA76ED395');
        $this->addSql('DROP INDEX IDX_4E57311CE934951A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_exercise AS SELECT exercise_id, user_id FROM user_exercise');
        $this->addSql('DROP TABLE user_exercise');
        $this->addSql('CREATE TABLE user_exercise (exercise_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(exercise_id, user_id), CONSTRAINT FK_4E57311CE934951A FOREIGN KEY (exercise_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_4E57311CA76ED395 FOREIGN KEY (user_id) REFERENCES exercise (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user_exercise (exercise_id, user_id) SELECT exercise_id, user_id FROM __temp__user_exercise');
        $this->addSql('DROP TABLE __temp__user_exercise');
        $this->addSql('CREATE INDEX IDX_4E57311CA76ED395 ON user_exercise (user_id)');
        $this->addSql('CREATE INDEX IDX_4E57311CE934951A ON user_exercise (exercise_id)');
        $this->addSql('DROP INDEX IDX_85E4E46CD17C3821');
        $this->addSql('DROP INDEX IDX_85E4E46CA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_consumption AS SELECT consumption_id, user_id FROM user_consumption');
        $this->addSql('DROP TABLE user_consumption');
        $this->addSql('CREATE TABLE user_consumption (consumption_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(consumption_id, user_id), CONSTRAINT FK_85E4E46CD17C3821 FOREIGN KEY (consumption_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_85E4E46CA76ED395 FOREIGN KEY (user_id) REFERENCES consumption (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user_consumption (consumption_id, user_id) SELECT consumption_id, user_id FROM __temp__user_consumption');
        $this->addSql('DROP TABLE __temp__user_consumption');
        $this->addSql('CREATE INDEX IDX_85E4E46CD17C3821 ON user_consumption (consumption_id)');
        $this->addSql('CREATE INDEX IDX_85E4E46CA76ED395 ON user_consumption (user_id)');
        $this->addSql('DROP INDEX IDX_EDF139F4F03FB5E1');
        $this->addSql('DROP INDEX IDX_EDF139F4A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_sleep AS SELECT sleep_id, user_id FROM user_sleep');
        $this->addSql('DROP TABLE user_sleep');
        $this->addSql('CREATE TABLE user_sleep (sleep_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(sleep_id, user_id), CONSTRAINT FK_EDF139F4F03FB5E1 FOREIGN KEY (sleep_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_EDF139F4A76ED395 FOREIGN KEY (user_id) REFERENCES sleep (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user_sleep (sleep_id, user_id) SELECT sleep_id, user_id FROM __temp__user_sleep');
        $this->addSql('DROP TABLE __temp__user_sleep');
        $this->addSql('CREATE INDEX IDX_EDF139F4F03FB5E1 ON user_sleep (sleep_id)');
        $this->addSql('CREATE INDEX IDX_EDF139F4A76ED395 ON user_sleep (user_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE equipment (id INTEGER NOT NULL, Name VARCHAR(255) NOT NULL COLLATE BINARY, Location VARCHAR(255) DEFAULT NULL COLLATE BINARY, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE exercice_set (id INTEGER NOT NULL, Reps INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP INDEX IDX_85E4E46CD17C3821');
        $this->addSql('DROP INDEX IDX_85E4E46CA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_consumption AS SELECT consumption_id, user_id FROM user_consumption');
        $this->addSql('DROP TABLE user_consumption');
        $this->addSql('CREATE TABLE user_consumption (consumption_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(consumption_id, user_id))');
        $this->addSql('INSERT INTO user_consumption (consumption_id, user_id) SELECT consumption_id, user_id FROM __temp__user_consumption');
        $this->addSql('DROP TABLE __temp__user_consumption');
        $this->addSql('CREATE INDEX IDX_85E4E46CD17C3821 ON user_consumption (consumption_id)');
        $this->addSql('CREATE INDEX IDX_85E4E46CA76ED395 ON user_consumption (user_id)');
        $this->addSql('DROP INDEX IDX_4E57311CE934951A');
        $this->addSql('DROP INDEX IDX_4E57311CA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_exercise AS SELECT exercise_id, user_id FROM user_exercise');
        $this->addSql('DROP TABLE user_exercise');
        $this->addSql('CREATE TABLE user_exercise (exercise_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(exercise_id, user_id))');
        $this->addSql('INSERT INTO user_exercise (exercise_id, user_id) SELECT exercise_id, user_id FROM __temp__user_exercise');
        $this->addSql('DROP TABLE __temp__user_exercise');
        $this->addSql('CREATE INDEX IDX_4E57311CE934951A ON user_exercise (exercise_id)');
        $this->addSql('CREATE INDEX IDX_4E57311CA76ED395 ON user_exercise (user_id)');
        $this->addSql('DROP INDEX IDX_EDF139F4F03FB5E1');
        $this->addSql('DROP INDEX IDX_EDF139F4A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_sleep AS SELECT sleep_id, user_id FROM user_sleep');
        $this->addSql('DROP TABLE user_sleep');
        $this->addSql('CREATE TABLE user_sleep (sleep_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(sleep_id, user_id))');
        $this->addSql('INSERT INTO user_sleep (sleep_id, user_id) SELECT sleep_id, user_id FROM __temp__user_sleep');
        $this->addSql('DROP TABLE __temp__user_sleep');
        $this->addSql('CREATE INDEX IDX_EDF139F4F03FB5E1 ON user_sleep (sleep_id)');
        $this->addSql('CREATE INDEX IDX_EDF139F4A76ED395 ON user_sleep (user_id)');
    }
}
