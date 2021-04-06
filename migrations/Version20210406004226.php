<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210406004226 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql("INSERT INTO windsor_telecom.clients (id, first_name, last_name, email) VALUES (1, 'Jhon', 'Smith', 'js@test.com');
                           INSERT INTO windsor_telecom.clients (id, first_name, last_name, email) VALUES (2, 'Murphy', 'Weset', 'mw@test.com');");

        $this->addSql("INSERT INTO windsor_telecom.actions (id, action) VALUES (1, '{\"type\": \"email\", \"template\": \"request_received\", \"recipient\": \"client\"}');
                           INSERT INTO windsor_telecom.actions (id, action) VALUES (2, '{\"type\": \"email\", \"template\": \"contract_send\", \"recipient\": \"client\"}');
                           INSERT INTO windsor_telecom.actions (id, action) VALUES (3, '{\"type\": \"email\", \"template\": \"follow_up\", \"recipient\": \"sales\"}');
                           INSERT INTO windsor_telecom.actions (id, action) VALUES (4, '{\"type\": \"save\"}');");

        $this->addSql("INSERT INTO windsor_telecom.workflows (id, code, title) VALUES (1, 'trial', 'Trial');
                           INSERT INTO windsor_telecom.workflows (id, code, title) VALUES (2, 'contract', 'Contract');");

        $this->addSql("INSERT INTO windsor_telecom.stages (id, code, title) VALUES (1, 'created', 'Created');
                           INSERT INTO windsor_telecom.stages (id, code, title) VALUES (2, 'approved', 'Approved');
                           INSERT INTO windsor_telecom.stages (id, code, title) VALUES (3, 'signed', 'Signed');
                           INSERT INTO windsor_telecom.stages (id, code, title) VALUES (4, 'delivered', 'Delivered');
                           INSERT INTO windsor_telecom.stages (id, code, title) VALUES (5, 'completed', 'Completed');
                           INSERT INTO windsor_telecom.stages (id, code, title) VALUES (6, 'expired', 'Expired');");

        $this->addSql("INSERT INTO windsor_telecom.workflow_stages (id, stage_id, workflow_id, action_id, `order`) VALUES (1, 1, 1, 1, '1');
                           INSERT INTO windsor_telecom.workflow_stages (id, stage_id, workflow_id, action_id, `order`) VALUES (2, 2, 1, null, '2');
                           INSERT INTO windsor_telecom.workflow_stages (id, stage_id, workflow_id, action_id, `order`) VALUES (3, 4, 1, 3, '3');
                           INSERT INTO windsor_telecom.workflow_stages (id, stage_id, workflow_id, action_id, `order`) VALUES (4, 5, 1, null, '4');
                           INSERT INTO windsor_telecom.workflow_stages (id, stage_id, workflow_id, action_id, `order`) VALUES (5, 6, 1, null, '5');
                           INSERT INTO windsor_telecom.workflow_stages (id, stage_id, workflow_id, action_id, `order`) VALUES (6, 1, 2, 1, '1');
                           INSERT INTO windsor_telecom.workflow_stages (id, stage_id, workflow_id, action_id, `order`) VALUES (7, 2, 2, 2, '2');
                           INSERT INTO windsor_telecom.workflow_stages (id, stage_id, workflow_id, action_id, `order`) VALUES (8, 3, 2, 4, '3');
                           INSERT INTO windsor_telecom.workflow_stages (id, stage_id, workflow_id, action_id, `order`) VALUES (9, 4, 2, 3, '4');
                           INSERT INTO windsor_telecom.workflow_stages (id, stage_id, workflow_id, action_id, `order`) VALUES (10, 5, 2, null, '5');");

        $this->addSql("INSERT INTO windsor_telecom.orders (id, stage_id, workflow_id, customer_id) VALUES (1, 2, 1, 1);
                           INSERT INTO windsor_telecom.orders (id, stage_id, workflow_id, customer_id) VALUES (2, 2, 1, 2);
                           INSERT INTO windsor_telecom.orders (id, stage_id, workflow_id, customer_id) VALUES (3, 2, 2, 1);");
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE actions ADD type LONGTEXT CHARACTER SET utf8mb4 NOT NULL COLLATE `utf8mb4_unicode_ci`');
    }
}
