<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160913091349 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE feedback_field_definition ADD anonymise_after_days INT DEFAULT 0 NOT NULL');
        $this->addSql('ALTER TABLE feedback_field_value_string ADD is_anonymised TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE feedback_field_value_text ADD is_anonymised TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE feedback_field_value_email ADD is_anonymised TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE feedback_field_value_url ADD is_anonymised TINYINT(1) DEFAULT \'0\' NOT NULL');
        $this->addSql('ALTER TABLE feedback_field_value_browser_user_agent ADD is_anonymised TINYINT(1) DEFAULT \'0\' NOT NULL');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE feedback_field_definition DROP anonymise_after_days');
        $this->addSql('ALTER TABLE feedback_field_value_browser_user_agent DROP is_anonymised');
        $this->addSql('ALTER TABLE feedback_field_value_email DROP is_anonymised');
        $this->addSql('ALTER TABLE feedback_field_value_string DROP is_anonymised');
        $this->addSql('ALTER TABLE feedback_field_value_text DROP is_anonymised');
        $this->addSql('ALTER TABLE feedback_field_value_url DROP is_anonymised');
    }
}
