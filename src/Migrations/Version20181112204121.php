<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20181112204121 extends AbstractMigration
{
    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('DROP TABLE payment_category');
        $this->addSql('DROP TABLE payment_user');
        $this->addSql('ALTER TABLE payment ADD user_id INT NOT NULL, ADD category_id INT NOT NULL');
        $this->addSql('ALTER TABLE user CHANGE password password VARCHAR(32) NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf('mysql' !== $this->connection->getDatabasePlatform()->getName(), 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE payment_category (payment_id INT NOT NULL, category_id INT NOT NULL, INDEX IDX_468A5BA94C3A3BB (payment_id), INDEX IDX_468A5BA912469DE2 (category_id), PRIMARY KEY(payment_id, category_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment_user (payment_id INT NOT NULL, user_id INT NOT NULL, INDEX IDX_AC10413D4C3A3BB (payment_id), INDEX IDX_AC10413DA76ED395 (user_id), PRIMARY KEY(payment_id, user_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE payment_category ADD CONSTRAINT FK_468A5BA912469DE2 FOREIGN KEY (category_id) REFERENCES category (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payment_category ADD CONSTRAINT FK_468A5BA94C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payment_user ADD CONSTRAINT FK_AC10413DA76ED395 FOREIGN KEY (user_id) REFERENCES user (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payment_user ADD CONSTRAINT FK_AC10413D4C3A3BB FOREIGN KEY (payment_id) REFERENCES payment (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payment DROP user_id, DROP category_id');
        $this->addSql('ALTER TABLE user CHANGE password password VARCHAR(100) NOT NULL COLLATE utf8mb4_unicode_ci');
    }
}
