<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20240119093818 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE apuesta (id INT AUTO_INCREMENT NOT NULL, ticket_id INT DEFAULT NULL, user_id INT DEFAULT NULL, sorteo_id INT DEFAULT NULL, INDEX IDX_A114C655700047D2 (ticket_id), INDEX IDX_A114C655A76ED395 (user_id), INDEX IDX_A114C655663FD436 (sorteo_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE sorteo_ticket (sorteo_id INT NOT NULL, ticket_id INT NOT NULL, INDEX IDX_E7A088C3663FD436 (sorteo_id), INDEX IDX_E7A088C3700047D2 (ticket_id), PRIMARY KEY(sorteo_id, ticket_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE apuesta ADD CONSTRAINT FK_A114C655700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id)');
        $this->addSql('ALTER TABLE apuesta ADD CONSTRAINT FK_A114C655A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('ALTER TABLE apuesta ADD CONSTRAINT FK_A114C655663FD436 FOREIGN KEY (sorteo_id) REFERENCES sorteo (id)');
        $this->addSql('ALTER TABLE sorteo_ticket ADD CONSTRAINT FK_E7A088C3663FD436 FOREIGN KEY (sorteo_id) REFERENCES sorteo (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sorteo_ticket ADD CONSTRAINT FK_E7A088C3700047D2 FOREIGN KEY (ticket_id) REFERENCES ticket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE sorteo ADD numero_ganador INT DEFAULT NULL, DROP numero_premiado, DROP id_ganador, CHANGE nombre name VARCHAR(255) NOT NULL, CHANGE ticket_totales tickets_totales INT NOT NULL');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3663FD436');
        $this->addSql('ALTER TABLE ticket DROP FOREIGN KEY FK_97A0ADA3A76ED395');
        $this->addSql('DROP INDEX IDX_97A0ADA3663FD436 ON ticket');
        $this->addSql('DROP INDEX IDX_97A0ADA3A76ED395 ON ticket');
        $this->addSql('ALTER TABLE ticket DROP sorteo_id, DROP user_id, DROP estado');
        $this->addSql('ALTER TABLE user CHANGE saldo saldo INT DEFAULT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE apuesta DROP FOREIGN KEY FK_A114C655700047D2');
        $this->addSql('ALTER TABLE apuesta DROP FOREIGN KEY FK_A114C655A76ED395');
        $this->addSql('ALTER TABLE apuesta DROP FOREIGN KEY FK_A114C655663FD436');
        $this->addSql('ALTER TABLE sorteo_ticket DROP FOREIGN KEY FK_E7A088C3663FD436');
        $this->addSql('ALTER TABLE sorteo_ticket DROP FOREIGN KEY FK_E7A088C3700047D2');
        $this->addSql('DROP TABLE apuesta');
        $this->addSql('DROP TABLE sorteo_ticket');
        $this->addSql('ALTER TABLE sorteo ADD id_ganador INT DEFAULT NULL, CHANGE name nombre VARCHAR(255) NOT NULL, CHANGE tickets_totales ticket_totales INT NOT NULL, CHANGE numero_ganador numero_premiado INT DEFAULT NULL');
        $this->addSql('ALTER TABLE ticket ADD sorteo_id INT DEFAULT NULL, ADD user_id INT DEFAULT NULL, ADD estado INT NOT NULL');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3663FD436 FOREIGN KEY (sorteo_id) REFERENCES sorteo (id)');
        $this->addSql('ALTER TABLE ticket ADD CONSTRAINT FK_97A0ADA3A76ED395 FOREIGN KEY (user_id) REFERENCES user (id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3663FD436 ON ticket (sorteo_id)');
        $this->addSql('CREATE INDEX IDX_97A0ADA3A76ED395 ON ticket (user_id)');
        $this->addSql('ALTER TABLE user CHANGE saldo saldo INT NOT NULL');
    }
}
