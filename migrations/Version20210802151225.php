<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20210802151225 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE rent (id INT AUTO_INCREMENT NOT NULL, id_client_id INT NOT NULL, date_rent DATE NOT NULL, length_rent INT NOT NULL, return_date DATE NOT NULL, actual_return_date DATE DEFAULT NULL, is_delayed TINYINT(1) NOT NULL, price_rent DOUBLE PRECISION NOT NULL, delay_price DOUBLE PRECISION NOT NULL, INDEX IDX_2784DCC99DED506 (id_client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rent_movie (rent_id INT NOT NULL, movie_id INT NOT NULL, INDEX IDX_FC2000D9E5FD6250 (rent_id), INDEX IDX_FC2000D98F93B6FC (movie_id), PRIMARY KEY(rent_id, movie_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE rent ADD CONSTRAINT FK_2784DCC99DED506 FOREIGN KEY (id_client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE rent_movie ADD CONSTRAINT FK_FC2000D9E5FD6250 FOREIGN KEY (rent_id) REFERENCES rent (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE rent_movie ADD CONSTRAINT FK_FC2000D98F93B6FC FOREIGN KEY (movie_id) REFERENCES movie (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE movie ADD stock INT NOT NULL, ADD offer_type INT NOT NULL');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE rent_movie DROP FOREIGN KEY FK_FC2000D9E5FD6250');
        $this->addSql('DROP TABLE rent');
        $this->addSql('DROP TABLE rent_movie');
        $this->addSql('ALTER TABLE movie DROP stock, DROP offer_type');
    }
}
