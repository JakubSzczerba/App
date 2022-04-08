<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20220408105600 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE proposal_filled ADD users_id INT NOT NULL');
        $this->addSql('ALTER TABLE proposal_filled ADD CONSTRAINT FK_38337C3367B3B43D FOREIGN KEY (users_id) REFERENCES user (id)');
        $this->addSql('CREATE UNIQUE INDEX UNIQ_38337C3367B3B43D ON proposal_filled (users_id)');
        $this->addSql('ALTER TABLE user DROP user_id');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE proposal_filled DROP FOREIGN KEY FK_38337C3367B3B43D');
        $this->addSql('DROP INDEX UNIQ_38337C3367B3B43D ON proposal_filled');
        $this->addSql('ALTER TABLE proposal_filled DROP users_id');
        $this->addSql('ALTER TABLE user ADD user_id INT NOT NULL');
    }
}
