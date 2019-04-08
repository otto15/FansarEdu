<?php declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181222223657 extends AbstractMigration
{
    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('DROP TABLE answer');
        $this->addSql('DROP TABLE lesson');
        $this->addSql('DROP TABLE question');
        $this->addSql('DROP TABLE term');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'sqlite', 'Migration can only be executed safely on \'sqlite\'.');

        $this->addSql('CREATE TABLE answer (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, question_id INTEGER NOT NULL, answer VARCHAR(255) NOT NULL COLLATE BINARY, correct_answer VARCHAR(255) NOT NULL COLLATE BINARY, wrong_answers CLOB NOT NULL COLLATE BINARY)');
        $this->addSql('CREATE INDEX IDX_DADD4A251E27F6BF ON answer (question_id)');
        $this->addSql('CREATE TABLE lesson (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, subject_id INTEGER DEFAULT NULL, topic VARCHAR(255) NOT NULL COLLATE BINARY, short_description CLOB NOT NULL COLLATE BINARY, lesson_description CLOB NOT NULL COLLATE BINARY, link_to_video VARCHAR(255) DEFAULT NULL COLLATE BINARY)');
        $this->addSql('CREATE INDEX IDX_F87474F323EDC87 ON lesson (subject_id)');
        $this->addSql('CREATE TABLE question (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lesson_id INTEGER DEFAULT NULL, question CLOB NOT NULL COLLATE BINARY)');
        $this->addSql('CREATE INDEX IDX_B6F7494ECDF80196 ON question (lesson_id)');
        $this->addSql('CREATE TABLE term (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, lesson_id INTEGER NOT NULL, term VARCHAR(255) NOT NULL COLLATE BINARY, definition CLOB NOT NULL COLLATE BINARY)');
        $this->addSql('CREATE INDEX IDX_A50FE78DCDF80196 ON term (lesson_id)');
    }
}
