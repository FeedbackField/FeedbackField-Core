<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160531085435 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE feedback_field_value_browser_user_agent ADD value_device_type VARCHAR(250) DEFAULT NULL, ADD value_device_pointing_method VARCHAR(250) DEFAULT NULL, ADD value_comment VARCHAR(250) DEFAULT NULL, ADD value_parent VARCHAR(250) DEFAULT NULL, ADD value_browser VARCHAR(250) DEFAULT NULL, ADD value_browser_maker VARCHAR(250) DEFAULT NULL, ADD value_platform VARCHAR(250) DEFAULT NULL, ADD value_version VARCHAR(250) DEFAULT NULL, ADD value_version_major VARCHAR(250) DEFAULT NULL, ADD value_version_minor VARCHAR(250) DEFAULT NULL, ADD value_is_mobile TINYINT(1) DEFAULT NULL, ADD value_is_tablet TINYINT(1) DEFAULT NULL, ADD value_is_crawler TINYINT(1) DEFAULT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE feedback_field_value_browser_user_agent DROP value_device_type, DROP value_device_pointing_method, DROP value_comment, DROP value_parent, DROP value_browser, DROP value_browser_maker, DROP value_platform, DROP value_version, DROP value_version_major, DROP value_version_minor, DROP value_is_mobile, DROP value_is_tablet, DROP value_is_crawler');
    }
}
