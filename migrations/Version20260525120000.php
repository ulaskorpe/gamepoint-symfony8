<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260525120000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'activity_log tablosunu oluşturur';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE activity_log (
            id BIGINT UNSIGNED AUTO_INCREMENT NOT NULL,
            log_name VARCHAR(191) DEFAULT NULL,
            description LONGTEXT NOT NULL,
            subject_type VARCHAR(191) DEFAULT NULL,
            event VARCHAR(191) DEFAULT NULL,
            causer_type VARCHAR(191) DEFAULT NULL,
            properties JSON DEFAULT NULL,
            batch_uuid CHAR(36) DEFAULT NULL,
            created_at DATETIME DEFAULT NULL,
            updated_at DATETIME DEFAULT NULL,
            customer_id BIGINT UNSIGNED DEFAULT NULL,
            PRIMARY KEY(id)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE=InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE activity_log');
    }
}
