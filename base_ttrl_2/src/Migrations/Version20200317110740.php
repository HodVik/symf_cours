<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20200317110740 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE author (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE file (id INT AUTO_INCREMENT NOT NULL, author_id INT DEFAULT NULL, filename VARCHAR(255) NOT NULL, size INT NOT NULL, description VARCHAR(255) DEFAULT NULL, type VARCHAR(255) NOT NULL, INDEX IDX_8C9F3610F675F31B (author_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE pdf (id INT NOT NULL, page_number INT NOT NULL, orientation VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE video (id INT NOT NULL, format VARCHAR(255) NOT NULL, duration INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE file ADD CONSTRAINT FK_8C9F3610F675F31B FOREIGN KEY (author_id) REFERENCES author (id)');
        $this->addSql('ALTER TABLE pdf ADD CONSTRAINT FK_EF0DB8CBF396750 FOREIGN KEY (id) REFERENCES file (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE video ADD CONSTRAINT FK_7CC7DA2CBF396750 FOREIGN KEY (id) REFERENCES file (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE file DROP FOREIGN KEY FK_8C9F3610F675F31B');
        $this->addSql('ALTER TABLE pdf DROP FOREIGN KEY FK_EF0DB8CBF396750');
        $this->addSql('ALTER TABLE video DROP FOREIGN KEY FK_7CC7DA2CBF396750');
        $this->addSql('DROP TABLE author');
        $this->addSql('DROP TABLE file');
        $this->addSql('DROP TABLE pdf');
        $this->addSql('DROP TABLE video');
    }
}
