<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181225142243 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_335260351E27F6BF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__answer_choice AS SELECT id, question_id, correct_answer, wrong_ans1, wrong_ans2, wrong_ans3 FROM answer_choice');
        $this->addSql('DROP TABLE answer_choice');
        $this->addSql('CREATE TABLE answer_choice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, question_id INTEGER NOT NULL, correct_answer VARCHAR(255) NOT NULL COLLATE BINARY, wrong_ans1 VARCHAR(255) NOT NULL COLLATE BINARY, wrong_ans2 VARCHAR(255) DEFAULT NULL COLLATE BINARY, wrong_ans3 VARCHAR(255) DEFAULT NULL COLLATE BINARY, CONSTRAINT FK_335260351E27F6BF FOREIGN KEY (question_id) REFERENCES question (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO answer_choice (id, question_id, correct_answer, wrong_ans1, wrong_ans2, wrong_ans3) SELECT id, question_id, correct_answer, wrong_ans1, wrong_ans2, wrong_ans3 FROM __temp__answer_choice');
        $this->addSql('DROP TABLE __temp__answer_choice');
        $this->addSql('CREATE INDEX IDX_335260351E27F6BF ON answer_choice (question_id)');
        $this->addSql('DROP INDEX IDX_F87474F323EDC87');
        $this->addSql('CREATE TEMPORARY TABLE __temp__lesson AS SELECT id, subject_id, topic, short_description, lesson_description, videolink FROM lesson');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('CREATE TABLE lesson (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, subject_id INTEGER NOT NULL, topic VARCHAR(255) NOT NULL COLLATE BINARY, short_description CLOB NOT NULL COLLATE BINARY, lesson_description CLOB NOT NULL COLLATE BINARY, videolink VARCHAR(255) DEFAULT NULL COLLATE BINARY, created_date CLOB NOT NULL, CONSTRAINT FK_F87474F323EDC87 FOREIGN KEY (subject_id) REFERENCES subject (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO lesson (id, subject_id, topic, short_description, lesson_description, videolink) SELECT id, subject_id, topic, short_description, lesson_description, videolink FROM __temp__lesson');
        $this->addSql('DROP TABLE __temp__lesson');
        $this->addSql('CREATE INDEX IDX_F87474F323EDC87 ON lesson (subject_id)');
        $this->addSql('DROP INDEX IDX_B6F7494ECDF80196');
        $this->addSql('CREATE TEMPORARY TABLE __temp__question AS SELECT id, lesson_id, question FROM question');
        $this->addSql('DROP TABLE question');
        $this->addSql('CREATE TABLE question (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lesson_id INTEGER NOT NULL, question CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_B6F7494ECDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO question (id, lesson_id, question) SELECT id, lesson_id, question FROM __temp__question');
        $this->addSql('DROP TABLE __temp__question');
        $this->addSql('CREATE INDEX IDX_B6F7494ECDF80196 ON question (lesson_id)');
        $this->addSql('DROP INDEX IDX_A50FE78DCDF80196');
        $this->addSql('CREATE TEMPORARY TABLE __temp__term AS SELECT id, lesson_id, term, definition FROM term');
        $this->addSql('DROP TABLE term');
        $this->addSql('CREATE TABLE term (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lesson_id INTEGER NOT NULL, term VARCHAR(255) NOT NULL COLLATE BINARY, definition CLOB NOT NULL COLLATE BINARY, CONSTRAINT FK_A50FE78DCDF80196 FOREIGN KEY (lesson_id) REFERENCES lesson (id) NOT DEFERRABLE INITIALLY IMMEDIATE)');
        $this->addSql('INSERT INTO term (id, lesson_id, term, definition) SELECT id, lesson_id, term, definition FROM __temp__term');
        $this->addSql('DROP TABLE __temp__term');
        $this->addSql('CREATE INDEX IDX_A50FE78DCDF80196 ON term (lesson_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP INDEX IDX_335260351E27F6BF');
        $this->addSql('CREATE TEMPORARY TABLE __temp__answer_choice AS SELECT id, question_id, correct_answer, wrong_ans1, wrong_ans2, wrong_ans3 FROM answer_choice');
        $this->addSql('DROP TABLE answer_choice');
        $this->addSql('CREATE TABLE answer_choice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, question_id INTEGER NOT NULL, correct_answer VARCHAR(255) NOT NULL, wrong_ans1 VARCHAR(255) NOT NULL, wrong_ans2 VARCHAR(255) DEFAULT NULL, wrong_ans3 VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO answer_choice (id, question_id, correct_answer, wrong_ans1, wrong_ans2, wrong_ans3) SELECT id, question_id, correct_answer, wrong_ans1, wrong_ans2, wrong_ans3 FROM __temp__answer_choice');
        $this->addSql('DROP TABLE __temp__answer_choice');
        $this->addSql('CREATE INDEX IDX_335260351E27F6BF ON answer_choice (question_id)');
        $this->addSql('DROP INDEX IDX_F87474F323EDC87');
        $this->addSql('CREATE TEMPORARY TABLE __temp__lesson AS SELECT id, subject_id, topic, short_description, lesson_description, videolink FROM lesson');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('CREATE TABLE lesson (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, subject_id INTEGER NOT NULL, topic VARCHAR(255) NOT NULL, short_description CLOB NOT NULL, lesson_description CLOB NOT NULL, videolink VARCHAR(255) DEFAULT NULL)');
        $this->addSql('INSERT INTO lesson (id, subject_id, topic, short_description, lesson_description, videolink) SELECT id, subject_id, topic, short_description, lesson_description, videolink FROM __temp__lesson');
        $this->addSql('DROP TABLE __temp__lesson');
        $this->addSql('CREATE INDEX IDX_F87474F323EDC87 ON lesson (subject_id)');
        $this->addSql('DROP INDEX IDX_B6F7494ECDF80196');
        $this->addSql('CREATE TEMPORARY TABLE __temp__question AS SELECT id, lesson_id, question FROM question');
        $this->addSql('DROP TABLE question');
        $this->addSql('CREATE TABLE question (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lesson_id INTEGER NOT NULL, question CLOB NOT NULL)');
        $this->addSql('INSERT INTO question (id, lesson_id, question) SELECT id, lesson_id, question FROM __temp__question');
        $this->addSql('DROP TABLE __temp__question');
        $this->addSql('CREATE INDEX IDX_B6F7494ECDF80196 ON question (lesson_id)');
        $this->addSql('DROP INDEX IDX_A50FE78DCDF80196');
        $this->addSql('CREATE TEMPORARY TABLE __temp__term AS SELECT id, lesson_id, term, definition FROM term');
        $this->addSql('DROP TABLE term');
        $this->addSql('CREATE TABLE term (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lesson_id INTEGER NOT NULL, term VARCHAR(255) NOT NULL, definition CLOB NOT NULL)');
        $this->addSql('INSERT INTO term (id, lesson_id, term, definition) SELECT id, lesson_id, term, definition FROM __temp__term');
        $this->addSql('DROP TABLE __temp__term');
        $this->addSql('CREATE INDEX IDX_A50FE78DCDF80196 ON term (lesson_id)');
    }
}
