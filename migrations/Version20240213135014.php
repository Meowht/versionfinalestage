<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240213135014 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE upload_image ADD user_id INT DEFAULT NULL');
        $this->addSql('ALTER TABLE upload_image ADD CONSTRAINT FK_EC604940A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id)');
        $this->addSql('CREATE INDEX IDX_EC604940A76ED395 ON upload_image (user_id)');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE upload_image DROP FOREIGN KEY FK_EC604940A76ED395');
        $this->addSql('DROP INDEX IDX_EC604940A76ED395 ON upload_image');
        $this->addSql('ALTER TABLE upload_image DROP user_id');
    }
}
