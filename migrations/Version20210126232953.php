<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210126232953 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE user (id INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL, manager_id INTEGER DEFAULT NULL, username VARCHAR(255) NOT NULL, password VARCHAR(255) DEFAULT NULL)');
        $this->addSql('CREATE INDEX IDX_8D93D649783E3463 ON user (manager_id)');
        $this->addSql(
            <<<'SQL'
            INSERT INTO user (id, manager_id, username, password) VALUES
                (1, NULL, "user_1", "$argon2id$v=19$m=65536,t=4,p=1$4IRipLyJ9u0HIzTET08NMw$W20jcLDiQiyySpoz1r2M3Wc0XAbcyK7zcx+FLRfQhkQ"),
                (2, 1, "user_2_a", NULL),
                (3, 1, "user_2_b", NULL),
                (4, 2, "user_3_a", NULL),
                (5, 2, "user_3_b", NULL),
                (6, 3, "user_3_c", NULL),
                (7, 3, "user_3_d", NULL)
            SQL
        );
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('DROP TABLE user');
    }
}
