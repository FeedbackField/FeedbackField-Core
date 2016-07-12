<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160712143337 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE feedback_field_value_email (feedback_id BIGINT NOT NULL, feedback_field_definition_id BIGINT NOT NULL, value LONGTEXT DEFAULT NULL, INDEX IDX_1ECBEC9CD249A887 (feedback_id), INDEX IDX_1ECBEC9C5C14CF88 (feedback_field_definition_id), PRIMARY KEY(feedback_id, feedback_field_definition_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE feedback_field_value_email ADD CONSTRAINT FK_1ECBEC9CD249A887 FOREIGN KEY (feedback_id) REFERENCES feedback (id)');
        $this->addSql('ALTER TABLE feedback_field_value_email ADD CONSTRAINT FK_1ECBEC9C5C14CF88 FOREIGN KEY (feedback_field_definition_id) REFERENCES feedback_field_definition (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE feedback_field_value_email');
    }
}
