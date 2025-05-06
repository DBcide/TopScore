<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250506125844 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE partie ADD user_id INT NOT NULL, ADD jeu_id INT NOT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE partie ADD CONSTRAINT FK_59B1F3DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE partie ADD CONSTRAINT FK_59B1F3D8C9E392E FOREIGN KEY (jeu_id) REFERENCES jeu (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_59B1F3DA76ED395 ON partie (user_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_59B1F3D8C9E392E ON partie (jeu_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3DA76ED395
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE partie DROP FOREIGN KEY FK_59B1F3D8C9E392E
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_59B1F3DA76ED395 ON partie
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_59B1F3D8C9E392E ON partie
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE partie DROP user_id, DROP jeu_id
        SQL);
    }
}
