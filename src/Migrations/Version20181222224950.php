<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181222224950 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE answer_choice (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, question_id INTEGER NOT NULL, correct_answer VARCHAR(255) NOT NULL, wrong_ans1 VARCHAR(255) NOT NULL, wrong_ans2 VARCHAR(255) DEFAULT NULL, wrong_ans3 VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_335260351E27F6BF ON answer_choice (question_id)');
        $this->addSql('CREATE TABLE lesson (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, subject_id INTEGER NOT NULL, topic VARCHAR(255) NOT NULL, short_description CLOB NOT NULL, lesson_description CLOB NOT NULL, videolink VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_F87474F323EDC87 ON lesson (subject_id)');
        $this->addSql('CREATE TABLE question (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lesson_id INTEGER NOT NULL, question CLOB NOT NULL)');
        $this->addSql('CREATE INDEX IDX_B6F7494ECDF80196 ON question (lesson_id)');
        $this->addSql('CREATE TABLE term (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lesson_id INTEGER NOT NULL, term VARCHAR(255) NOT NULL, definition CLOB NOT NULL)');
        $this->addSql('CREATE INDEX IDX_A50FE78DCDF80196 ON term (lesson_id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE answer_choice');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE term');
    }
}
