<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20190318155119 extends AbstractMigration
{
    public function getDescription() : string
    {
        return '';
    }

    public function up(Schema $schema) : void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE service_pack DROP FOREIGN KEY FK_599DEACF1919B217');
        $this->addSql('ALTER TABLE partenaire_service DROP FOREIGN KEY FK_FE6C640598DE13AC');
        $this->addSql('ALTER TABLE partenaire_service DROP FOREIGN KEY FK_FE6C6405ED5CA9E6');
        $this->addSql('ALTER TABLE service_pack DROP FOREIGN KEY FK_599DEACFED5CA9E6');
        $this->addSql('DROP TABLE pack');
        $this->addSql('DROP TABLE partenaire');
        $this->addSql('DROP TABLE partenaire_service');
        $this->addSql('DROP TABLE service');
        $this->addSql('DROP TABLE service_pack');
    }

    public function down(Schema $schema) : void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE pack (id INT AUTO_INCREMENT NOT NULL, libelle_pack VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, image_pack VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE partenaire (id INT AUTO_INCREMENT NOT NULL, libelle_partenaire VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE partenaire_service (partenaire_id INT NOT NULL, service_id INT NOT NULL, INDEX IDX_FE6C640598DE13AC (partenaire_id), INDEX IDX_FE6C6405ED5CA9E6 (service_id), PRIMARY KEY(partenaire_id, service_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE service (id INT AUTO_INCREMENT NOT NULL, libelle_service VARCHAR(255) NOT NULL COLLATE utf8mb4_unicode_ci, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('CREATE TABLE service_pack (service_id INT NOT NULL, pack_id INT NOT NULL, INDEX IDX_599DEACFED5CA9E6 (service_id), INDEX IDX_599DEACF1919B217 (pack_id), PRIMARY KEY(service_id, pack_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB COMMENT = \'\' ');
        $this->addSql('ALTER TABLE partenaire_service ADD CONSTRAINT FK_FE6C640598DE13AC FOREIGN KEY (partenaire_id) REFERENCES partenaire (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE partenaire_service ADD CONSTRAINT FK_FE6C6405ED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_pack ADD CONSTRAINT FK_599DEACF1919B217 FOREIGN KEY (pack_id) REFERENCES pack (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE service_pack ADD CONSTRAINT FK_599DEACFED5CA9E6 FOREIGN KEY (service_id) REFERENCES service (id) ON DELETE CASCADE');
    }
}
