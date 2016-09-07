<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160907112712 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_2CFF2DF9A76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__consumption AS SELECT id, user_id FROM consumption');
        $this->addSql('DROP TABLE consumption');
        $this->addSql('CREATE TABLE consumption (id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, type VARCHAR(255) DEFAULT NULL, name VARCHAR(255) DEFAULT NULL, PRIMARY KEY(id), CONSTRAINT FK_2CFF2DF9A76ED395 FOREIGN KEY (user_id) REFERENCES user (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO consumption (id, user_id) SELECT id, user_id FROM __temp__consumption');
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
        $this->addSql('DROP INDEX IDX_1890B54EF03FB5E1');
        $this->addSql('DROP INDEX IDX_1890B54EA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sleep_user AS SELECT sleep_id, user_id FROM sleep_user');
        $this->addSql('DROP TABLE sleep_user');
        $this->addSql('CREATE TABLE sleep_user (sleep_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(sleep_id, user_id), CONSTRAINT FK_1890B54EF03FB5E1 FOREIGN KEY (sleep_id) REFERENCES sleep (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE, CONSTRAINT FK_1890B54EA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO sleep_user (sleep_id, user_id) SELECT sleep_id, user_id FROM __temp__sleep_user');
        $this->addSql('DROP TABLE __temp__sleep_user');
        $this->addSql('CREATE INDEX IDX_1890B54EF03FB5E1 ON sleep_user (sleep_id)');
        $this->addSql('CREATE INDEX IDX_1890B54EA76ED395 ON sleep_user (user_id)');
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
        $this->addSql('CREATE TEMPORARY TABLE __temp__consumption AS SELECT id, user_id FROM consumption');
        $this->addSql('DROP TABLE consumption');
        $this->addSql('CREATE TABLE consumption (id INTEGER NOT NULL, user_id INTEGER DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('INSERT INTO consumption (id, user_id) SELECT id, user_id FROM __temp__consumption');
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
        $this->addSql('DROP INDEX IDX_1890B54EF03FB5E1');
        $this->addSql('DROP INDEX IDX_1890B54EA76ED395');
        $this->addSql('CREATE TEMPORARY TABLE __temp__sleep_user AS SELECT sleep_id, user_id FROM sleep_user');
        $this->addSql('DROP TABLE sleep_user');
        $this->addSql('CREATE TABLE sleep_user (sleep_id INTEGER NOT NULL, user_id INTEGER NOT NULL, PRIMARY KEY(sleep_id, user_id))');
        $this->addSql('INSERT INTO sleep_user (sleep_id, user_id) SELECT sleep_id, user_id FROM __temp__sleep_user');
        $this->addSql('DROP TABLE __temp__sleep_user');
        $this->addSql('CREATE INDEX IDX_1890B54EF03FB5E1 ON sleep_user (sleep_id)');
        $this->addSql('CREATE INDEX IDX_1890B54EA76ED395 ON sleep_user (user_id)');
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
