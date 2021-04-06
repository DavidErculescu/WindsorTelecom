<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210406004225 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE actions (id INT AUTO_INCREMENT NOT NULL, action JSON DEFAULT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE clients (id INT AUTO_INCREMENT NOT NULL, first_name LONGTEXT NOT NULL, last_name LONGTEXT NOT NULL, email VARCHAR(255) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, stage_id INT DEFAULT NULL, workflow_id INT DEFAULT NULL, customer_id INT DEFAULT NULL, INDEX IDX_E52FFDEE2298D193 (stage_id), INDEX IDX_E52FFDEE2C7C2CBA (workflow_id), INDEX IDX_E52FFDEE9395C3F3 (customer_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE stages (id INT AUTO_INCREMENT NOT NULL, code LONGTEXT NOT NULL, title LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workflow_stages (id INT AUTO_INCREMENT NOT NULL, stage_id INT DEFAULT NULL, workflow_id INT DEFAULT NULL, action_id INT DEFAULT NULL, `order` LONGTEXT NOT NULL, INDEX IDX_EA7D0A72298D193 (stage_id), INDEX IDX_EA7D0A72C7C2CBA (workflow_id), INDEX IDX_EA7D0A79D32F035 (action_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE workflows (id INT AUTO_INCREMENT NOT NULL, code LONGTEXT NOT NULL, title LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE2298D193 FOREIGN KEY (stage_id) REFERENCES stages (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE2C7C2CBA FOREIGN KEY (workflow_id) REFERENCES workflows (id)');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE9395C3F3 FOREIGN KEY (customer_id) REFERENCES clients (id)');
        $this->addSql('ALTER TABLE workflow_stages ADD CONSTRAINT FK_EA7D0A72298D193 FOREIGN KEY (stage_id) REFERENCES stages (id)');
        $this->addSql('ALTER TABLE workflow_stages ADD CONSTRAINT FK_EA7D0A72C7C2CBA FOREIGN KEY (workflow_id) REFERENCES workflows (id)');
        $this->addSql('ALTER TABLE workflow_stages ADD CONSTRAINT FK_EA7D0A79D32F035 FOREIGN KEY (action_id) REFERENCES actions (id)');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE workflow_stages DROP FOREIGN KEY FK_EA7D0A79D32F035');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE9395C3F3');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE2298D193');
        $this->addSql('ALTER TABLE workflow_stages DROP FOREIGN KEY FK_EA7D0A72298D193');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE2C7C2CBA');
        $this->addSql('ALTER TABLE workflow_stages DROP FOREIGN KEY FK_EA7D0A72C7C2CBA');
        $this->addSql('DROP TABLE actions');
        $this->addSql('DROP TABLE clients');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE stages');
        $this->addSql('DROP TABLE workflow_stages');
        $this->addSql('DROP TABLE workflows');
    }
}
