<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260515160000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'sys_log created_at / updated_at: TIME -> TIMESTAMP (tam tarih-saat)';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sys_log CHANGE created_at created_at TIMESTAMP DEFAULT NULL, CHANGE updated_at updated_at TIMESTAMP DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('ALTER TABLE sys_log CHANGE created_at created_at TIME DEFAULT NULL, CHANGE updated_at updated_at DATETIME DEFAULT NULL');
    }
}
