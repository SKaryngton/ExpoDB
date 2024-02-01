<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231222123029 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE dialog (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, s VARCHAR(255) NOT NULL, p CLOB NOT NULL --(DC2Type:json)
        , o VARCHAR(255) NOT NULL, a CLOB NOT NULL --(DC2Type:json)
        , b CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('CREATE TABLE story (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, s VARCHAR(255) NOT NULL, p CLOB NOT NULL --(DC2Type:json)
        , o VARCHAR(255) NOT NULL, a CLOB NOT NULL --(DC2Type:json)
        , b CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('CREATE TABLE messenger_messages (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, body CLOB NOT NULL, headers CLOB NOT NULL, queue_name VARCHAR(190) NOT NULL, created_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , available_at DATETIME NOT NULL --(DC2Type:datetime_immutable)
        , delivered_at DATETIME DEFAULT NULL --(DC2Type:datetime_immutable)
        )');
        $this->addSql('CREATE INDEX IDX_75EA56E0FB7336F0 ON messenger_messages (queue_name)');
        $this->addSql('CREATE INDEX IDX_75EA56E0E3BD61CE ON messenger_messages (available_at)');
        $this->addSql('CREATE INDEX IDX_75EA56E016BA31DB ON messenger_messages (delivered_at)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE dialog');
        $this->addSql('DROP TABLE story');
        $this->addSql('DROP TABLE messenger_messages');
    }
}
