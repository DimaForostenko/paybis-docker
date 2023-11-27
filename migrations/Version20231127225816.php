<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20231127225816 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE currency_rate ADD date DATE NOT NULL');
        $this->addSql('ALTER TABLE currency_rate ADD rate NUMERIC(16, 8) NOT NULL');
        $this->addSql('ALTER TABLE currency_rate ADD currency VARCHAR(3) NOT NULL');
        $this->addSql('COMMENT ON COLUMN currency_rate.date IS \'(DC2Type:date_immutable)\'');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('ALTER TABLE currency_rate DROP date');
        $this->addSql('ALTER TABLE currency_rate DROP rate');
        $this->addSql('ALTER TABLE currency_rate DROP currency');
    }
}
