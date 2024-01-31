<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129160338 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE todolist DROP FOREIGN KEY FK_DD4DF6DB9D86650F');
        $this->addSql('DROP INDEX IDX_DD4DF6DB9D86650F ON todolist');
        $this->addSql('ALTER TABLE todolist CHANGE user_id_id user_id INT NOT NULL');
        $this->addSql('ALTER TABLE todolist ADD CONSTRAINT FK_DD4DF6DBA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DD4DF6DBA76ED395 ON todolist (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE todolist DROP FOREIGN KEY FK_DD4DF6DBA76ED395');
        $this->addSql('DROP INDEX IDX_DD4DF6DBA76ED395 ON todolist');
        $this->addSql('ALTER TABLE todolist CHANGE user_id user_id_id INT NOT NULL');
        $this->addSql('ALTER TABLE todolist ADD CONSTRAINT FK_DD4DF6DB9D86650F FOREIGN KEY (user_id_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_DD4DF6DB9D86650F ON todolist (user_id_id)');
    }
}
