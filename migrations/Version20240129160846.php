<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240129160846 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task ADD todolist_id INT NOT NULL');
        $this->addSql('ALTER TABLE task ADD CONSTRAINT FK_527EDB25AD16642A FOREIGN KEY (todolist_id) REFERENCES todolist (id)');
        $this->addSql('CREATE INDEX IDX_527EDB25AD16642A ON task (todolist_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE task DROP FOREIGN KEY FK_527EDB25AD16642A');
        $this->addSql('DROP INDEX IDX_527EDB25AD16642A ON task');
        $this->addSql('ALTER TABLE task DROP todolist_id');
    }
}
