<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240125113802 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE stromberg (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, s VARCHAR(255) NOT NULL, p CLOB NOT NULL --(DC2Type:json)
        , o VARCHAR(255) NOT NULL, a CLOB NOT NULL --(DC2Type:json)
        , b CLOB NOT NULL --(DC2Type:json)
        )');
        $this->addSql('CREATE TABLE tfa (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, s VARCHAR(255) NOT NULL, p CLOB NOT NULL --(DC2Type:json)
        , o VARCHAR(255) NOT NULL, a CLOB NOT NULL --(DC2Type:json)
        , b CLOB NOT NULL --(DC2Type:json)
        )');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE stromberg');
        $this->addSql('DROP TABLE tfa');
    }
}
