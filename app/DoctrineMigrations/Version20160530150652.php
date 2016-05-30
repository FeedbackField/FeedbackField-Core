<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20160530150652 extends AbstractMigration
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE export (id BIGINT AUTO_INCREMENT NOT NULL, project_id BIGINT NOT NULL, public_id VARCHAR(250) NOT NULL, created_at DATETIME NOT NULL, type VARCHAR(250) NOT NULL, INDEX IDX_428C1694166D1F9C (project_id), UNIQUE INDEX public_id (project_id, public_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE export_log (export_id BIGINT NOT NULL, feedback_id BIGINT NOT NULL, created_at DATETIME NOT NULL, done_at DATETIME DEFAULT NULL, rejected_at DATETIME DEFAULT NULL, INDEX IDX_E7392FF564CDAF82 (export_id), INDEX IDX_E7392FF5D249A887 (feedback_id), PRIMARY KEY(export_id, feedback_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE export_only_if_feedback_field (export_id BIGINT NOT NULL, feedback_field_definition_id BIGINT NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_8114220F64CDAF82 (export_id), INDEX IDX_8114220F5C14CF88 (feedback_field_definition_id), PRIMARY KEY(export_id, feedback_field_definition_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE export_trello (export_id BIGINT NOT NULL, trello_key VARCHAR(250) DEFAULT NULL, trello_token VARCHAR(250) DEFAULT NULL, trello_list_id VARCHAR(250) DEFAULT NULL, PRIMARY KEY(export_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feedback (id BIGINT AUTO_INCREMENT NOT NULL, project_id BIGINT NOT NULL, public_id VARCHAR(250) NOT NULL, created_at DATETIME NOT NULL, INDEX IDX_D2294458166D1F9C (project_id), UNIQUE INDEX public_id (project_id, public_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feedback_field_definition (id BIGINT AUTO_INCREMENT NOT NULL, project_id BIGINT NOT NULL, added_by_id INT NOT NULL, public_id VARCHAR(250) NOT NULL, type VARCHAR(250) NOT NULL, title VARCHAR(250) NOT NULL, sort INT NOT NULL, added_at DATETIME NOT NULL, is_auto_fill TINYINT(1) NOT NULL, INDEX IDX_2190F39D166D1F9C (project_id), INDEX IDX_2190F39D55B127A4 (added_by_id), UNIQUE INDEX public_id (project_id, public_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE project (id BIGINT AUTO_INCREMENT NOT NULL, owner_id INT NOT NULL, public_id VARCHAR(250) NOT NULL, title VARCHAR(250) NOT NULL, is_active TINYINT(1) NOT NULL, created_at DATETIME NOT NULL, UNIQUE INDEX UNIQ_2FB3D0EEB5B48B91 (public_id), INDEX IDX_2FB3D0EE7E3C61F9 (owner_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE fos_user (id INT AUTO_INCREMENT NOT NULL, username VARCHAR(255) NOT NULL, username_canonical VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, email_canonical VARCHAR(255) NOT NULL, enabled TINYINT(1) NOT NULL, salt VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, last_login DATETIME DEFAULT NULL, locked TINYINT(1) NOT NULL, expired TINYINT(1) NOT NULL, expires_at DATETIME DEFAULT NULL, confirmation_token VARCHAR(255) DEFAULT NULL, password_requested_at DATETIME DEFAULT NULL, roles LONGTEXT NOT NULL COMMENT \'(DC2Type:array)\', credentials_expired TINYINT(1) NOT NULL, credentials_expire_at DATETIME DEFAULT NULL, UNIQUE INDEX UNIQ_957A647992FC23A8 (username_canonical), UNIQUE INDEX UNIQ_957A6479A0D96FBF (email_canonical), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feedback_field_value_string (feedback_id BIGINT NOT NULL, feedback_field_definition_id BIGINT NOT NULL, value VARCHAR(250) DEFAULT NULL, INDEX IDX_30968173D249A887 (feedback_id), INDEX IDX_309681735C14CF88 (feedback_field_definition_id), PRIMARY KEY(feedback_id, feedback_field_definition_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feedback_field_value_text (feedback_id BIGINT NOT NULL, feedback_field_definition_id BIGINT NOT NULL, value LONGTEXT DEFAULT NULL, INDEX IDX_DBC4205BD249A887 (feedback_id), INDEX IDX_DBC4205B5C14CF88 (feedback_field_definition_id), PRIMARY KEY(feedback_id, feedback_field_definition_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feedback_field_value_url (feedback_id BIGINT NOT NULL, feedback_field_definition_id BIGINT NOT NULL, value TINYTEXT DEFAULT NULL, value_scheme VARCHAR(250) DEFAULT NULL, value_host LONGTEXT DEFAULT NULL, value_port INT DEFAULT NULL, value_user LONGTEXT DEFAULT NULL, value_pass LONGTEXT DEFAULT NULL, value_path LONGTEXT DEFAULT NULL, value_query LONGTEXT DEFAULT NULL, value_fragment LONGTEXT DEFAULT NULL, INDEX IDX_6E18C7A4D249A887 (feedback_id), INDEX IDX_6E18C7A45C14CF88 (feedback_field_definition_id), PRIMARY KEY(feedback_id, feedback_field_definition_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE feedback_field_value_browser_user_agent (feedback_id BIGINT NOT NULL, feedback_field_definition_id BIGINT NOT NULL, value LONGTEXT DEFAULT NULL, INDEX IDX_E9B32102D249A887 (feedback_id), INDEX IDX_E9B321025C14CF88 (feedback_field_definition_id), PRIMARY KEY(feedback_id, feedback_field_definition_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE export ADD CONSTRAINT FK_428C1694166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE export_log ADD CONSTRAINT FK_E7392FF564CDAF82 FOREIGN KEY (export_id) REFERENCES export (id)');
        $this->addSql('ALTER TABLE export_log ADD CONSTRAINT FK_E7392FF5D249A887 FOREIGN KEY (feedback_id) REFERENCES feedback (id)');
        $this->addSql('ALTER TABLE export_only_if_feedback_field ADD CONSTRAINT FK_8114220F64CDAF82 FOREIGN KEY (export_id) REFERENCES export (id)');
        $this->addSql('ALTER TABLE export_only_if_feedback_field ADD CONSTRAINT FK_8114220F5C14CF88 FOREIGN KEY (feedback_field_definition_id) REFERENCES feedback_field_definition (id)');
        $this->addSql('ALTER TABLE export_trello ADD CONSTRAINT FK_8923A9C364CDAF82 FOREIGN KEY (export_id) REFERENCES export (id)');
        $this->addSql('ALTER TABLE feedback ADD CONSTRAINT FK_D2294458166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE feedback_field_definition ADD CONSTRAINT FK_2190F39D166D1F9C FOREIGN KEY (project_id) REFERENCES project (id)');
        $this->addSql('ALTER TABLE feedback_field_definition ADD CONSTRAINT FK_2190F39D55B127A4 FOREIGN KEY (added_by_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE project ADD CONSTRAINT FK_2FB3D0EE7E3C61F9 FOREIGN KEY (owner_id) REFERENCES fos_user (id)');
        $this->addSql('ALTER TABLE feedback_field_value_string ADD CONSTRAINT FK_30968173D249A887 FOREIGN KEY (feedback_id) REFERENCES feedback (id)');
        $this->addSql('ALTER TABLE feedback_field_value_string ADD CONSTRAINT FK_309681735C14CF88 FOREIGN KEY (feedback_field_definition_id) REFERENCES feedback_field_definition (id)');
        $this->addSql('ALTER TABLE feedback_field_value_text ADD CONSTRAINT FK_DBC4205BD249A887 FOREIGN KEY (feedback_id) REFERENCES feedback (id)');
        $this->addSql('ALTER TABLE feedback_field_value_text ADD CONSTRAINT FK_DBC4205B5C14CF88 FOREIGN KEY (feedback_field_definition_id) REFERENCES feedback_field_definition (id)');
        $this->addSql('ALTER TABLE feedback_field_value_url ADD CONSTRAINT FK_6E18C7A4D249A887 FOREIGN KEY (feedback_id) REFERENCES feedback (id)');
        $this->addSql('ALTER TABLE feedback_field_value_url ADD CONSTRAINT FK_6E18C7A45C14CF88 FOREIGN KEY (feedback_field_definition_id) REFERENCES feedback_field_definition (id)');
        $this->addSql('ALTER TABLE feedback_field_value_browser_user_agent ADD CONSTRAINT FK_E9B32102D249A887 FOREIGN KEY (feedback_id) REFERENCES feedback (id)');
        $this->addSql('ALTER TABLE feedback_field_value_browser_user_agent ADD CONSTRAINT FK_E9B321025C14CF88 FOREIGN KEY (feedback_field_definition_id) REFERENCES feedback_field_definition (id)');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() != 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE export_log DROP FOREIGN KEY FK_E7392FF564CDAF82');
        $this->addSql('ALTER TABLE export_only_if_feedback_field DROP FOREIGN KEY FK_8114220F64CDAF82');
        $this->addSql('ALTER TABLE export_trello DROP FOREIGN KEY FK_8923A9C364CDAF82');
        $this->addSql('ALTER TABLE export_log DROP FOREIGN KEY FK_E7392FF5D249A887');
        $this->addSql('ALTER TABLE feedback_field_value_string DROP FOREIGN KEY FK_30968173D249A887');
        $this->addSql('ALTER TABLE feedback_field_value_text DROP FOREIGN KEY FK_DBC4205BD249A887');
        $this->addSql('ALTER TABLE feedback_field_value_url DROP FOREIGN KEY FK_6E18C7A4D249A887');
        $this->addSql('ALTER TABLE feedback_field_value_browser_user_agent DROP FOREIGN KEY FK_E9B32102D249A887');
        $this->addSql('ALTER TABLE export_only_if_feedback_field DROP FOREIGN KEY FK_8114220F5C14CF88');
        $this->addSql('ALTER TABLE feedback_field_value_string DROP FOREIGN KEY FK_309681735C14CF88');
        $this->addSql('ALTER TABLE feedback_field_value_text DROP FOREIGN KEY FK_DBC4205B5C14CF88');
        $this->addSql('ALTER TABLE feedback_field_value_url DROP FOREIGN KEY FK_6E18C7A45C14CF88');
        $this->addSql('ALTER TABLE feedback_field_value_browser_user_agent DROP FOREIGN KEY FK_E9B321025C14CF88');
        $this->addSql('ALTER TABLE export DROP FOREIGN KEY FK_428C1694166D1F9C');
        $this->addSql('ALTER TABLE feedback DROP FOREIGN KEY FK_D2294458166D1F9C');
        $this->addSql('ALTER TABLE feedback_field_definition DROP FOREIGN KEY FK_2190F39D166D1F9C');
        $this->addSql('ALTER TABLE feedback_field_definition DROP FOREIGN KEY FK_2190F39D55B127A4');
        $this->addSql('ALTER TABLE project DROP FOREIGN KEY FK_2FB3D0EE7E3C61F9');
        $this->addSql('DROP TABLE export');
        $this->addSql('DROP TABLE export_log');
        $this->addSql('DROP TABLE export_only_if_feedback_field');
        $this->addSql('DROP TABLE export_trello');
        $this->addSql('DROP TABLE feedback');
        $this->addSql('DROP TABLE feedback_field_definition');
        $this->addSql('DROP TABLE project');
        $this->addSql('DROP TABLE fos_user');
        $this->addSql('DROP TABLE feedback_field_value_string');
        $this->addSql('DROP TABLE feedback_field_value_text');
        $this->addSql('DROP TABLE feedback_field_value_url');
        $this->addSql('DROP TABLE feedback_field_value_browser_user_agent');
    }
}
