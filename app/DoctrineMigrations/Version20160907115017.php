<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160907115017 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_2CFF2DF9A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__consumption AS SELECT id, user_id, type, name FROM consumption');
        $this->addSql('DROP TABLE consumption');
        $this->addSql('CREATE TABLE consumption (id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, type VARCHAR(255) DEFAULT NULL COLLATE BINARY, name VARCHAR(255) DEFAULT NULL COLLATE BINARY, PRIMARY KEY(id), CONSTRAINT FK_2CFF2DF9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO consumption (id, user_id, type, name) SELECT id, user_id, type, name FROM __temp__consumption');
        $this->addSql('DROP TABLE __temp__consumption');
        $this->addSql('CREATE INDEX IDX_2CFF2DF9A76ED395 ON consumption (user_id)');
        $this->addSql('DROP INDEX IDX_739D823BA76ED395');
        $this->addSql('DROP INDEX IDX_739D823BE934951A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__exercice_set AS SELECT id, user_id, exercise_id, reps FROM exercice_set');
        $this->addSql('DROP TABLE exercice_set');
        $this->addSql('CREATE TABLE exercice_set (id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, exercise_id INTEGER DEFAULT NULL, reps INTEGER DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_739D823BA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_739D823BE934951A FOREIGN KEY (exercise_id) REFERENCES exercise (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO exercice_set (id, user_id, exercise_id, reps) SELECT id, user_id, exercise_id, reps FROM __temp__exercice_set');
        $this->addSql('DROP TABLE __temp__exercice_set');
        $this->addSql('CREATE INDEX IDX_739D823BA76ED395 ON exercice_set (user_id)');
        $this->addSql('CREATE INDEX IDX_739D823BE934951A ON exercice_set (exercise_id)');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sleep AS SELECT id FROM sleep');
        $this->addSql('DROP TABLE sleep');
        $this->addSql('CREATE TABLE sleep (id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_F33C2ACA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sleep (id) SELECT id FROM __temp__sleep');
        $this->addSql('DROP TABLE __temp__sleep');
        $this->addSql('CREATE INDEX IDX_F33C2ACA76ED395 ON sleep (user_id)');
        $this->addSql('DROP INDEX IDX_4E57311CE934951A');
        $this->addSql('DROP INDEX IDX_4E57311CA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_exercise AS SELECT exercise_id, user_id FROM user_exercise');
        $this->addSql('DROP TABLE user_exercise');
        $this->addSql('CREATE TABLE user_exercise (exercise_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(exercise_id, user_id), CONSTRAINT FK_4E57311CE934951A FOREIGN KEY (exercise_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_4E57311CA76ED395 FOREIGN KEY (user_id) REFERENCES exercise (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO user_exercise (exercise_id, user_id) SELECT exercise_id, user_id FROM __temp__user_exercise');
        $this->addSql('DROP TABLE __temp__user_exercise');
        $this->addSql('CREATE INDEX IDX_4E57311CE934951A ON user_exercise (exercise_id)');
        $this->addSql('CREATE INDEX IDX_4E57311CA76ED395 ON user_exercise (user_id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_2CFF2DF9A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__consumption AS SELECT id, user_id, type, name FROM consumption');
        $this->addSql('DROP TABLE consumption');
        $this->addSql('CREATE TABLE consumption (id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO consumption (id, user_id, type, name) SELECT id, user_id, type, name FROM __temp__consumption');
        $this->addSql('DROP TABLE __temp__consumption');
        $this->addSql('CREATE INDEX IDX_2CFF2DF9A76ED395 ON consumption (user_id)');
        $this->addSql('DROP INDEX IDX_739D823BA76ED395');
        $this->addSql('DROP INDEX IDX_739D823BE934951A');
        $this->addSql('CREATE TEMPORARY TABLE __temp__exercice_set AS SELECT id, user_id, exercise_id, reps FROM exercice_set');
        $this->addSql('DROP TABLE exercice_set');
        $this->addSql('CREATE TABLE exercice_set (id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, exercise_id INTEGER DEFAULT NULL, reps INTEGER DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO exercice_set (id, user_id, exercise_id, reps) SELECT id, user_id, exercise_id, reps FROM __temp__exercice_set');
        $this->addSql('DROP TABLE __temp__exercice_set');
        $this->addSql('CREATE INDEX IDX_739D823BA76ED395 ON exercice_set (user_id)');
        $this->addSql('CREATE INDEX IDX_739D823BE934951A ON exercice_set (exercise_id)');
        $this->addSql('DROP INDEX IDX_F33C2ACA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sleep AS SELECT id FROM sleep');
        $this->addSql('DROP TABLE sleep');
        $this->addSql('CREATE TABLE sleep (id INTEGER NOT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO sleep (id) SELECT id FROM __temp__sleep');
        $this->addSql('DROP TABLE __temp__sleep');
        $this->addSql('DROP INDEX IDX_4E57311CE934951A');
        $this->addSql('DROP INDEX IDX_4E57311CA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__user_exercise AS SELECT exercise_id, user_id FROM user_exercise');
        $this->addSql('DROP TABLE user_exercise');
        $this->addSql('CREATE TABLE user_exercise (exercise_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(exercise_id, user_id))');
        $this->addSql('INSERT INTO user_exercise (exercise_id, user_id) SELECT exercise_id, user_id FROM __temp__user_exercise');
        $this->addSql('DROP TABLE __temp__user_exercise');
        $this->addSql('CREATE INDEX IDX_4E57311CE934951A ON user_exercise (exercise_id)');
        $this->addSql('CREATE INDEX IDX_4E57311CA76ED395 ON user_exercise (user_id)');
    }
}
