<?php declare(strict_types = 1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20180513084842 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('CREATE TABLE address (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, address_name VARCHAR(50) NOT NULL, address_type VARCHAR(50) NOT NULL, country VARCHAR(150) NOT NULL, address VARCHAR(255) NOT NULL, city VARCHAR(150) NOT NULL, postcode VARCHAR(20) NOT NULL, INDEX IDX_D4E6F8119EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE basket (id INT AUTO_INCREMENT NOT NULL, client_id INT NOT NULL, date DATE NOT NULL, INDEX IDX_2246507B19EB6921 (client_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE basket_schedule_date (basket_id INT NOT NULL, schedule_date_id INT NOT NULL, INDEX IDX_48F5CCD01BE1FB52 (basket_id), INDEX IDX_48F5CCD035FD1ADA (schedule_date_id), PRIMARY KEY(basket_id, schedule_date_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE basket_ticket_person (basket_id INT NOT NULL, ticket_person_id INT NOT NULL, INDEX IDX_4CBD604C1BE1FB52 (basket_id), INDEX IDX_4CBD604CBB41610D (ticket_person_id), PRIMARY KEY(basket_id, ticket_person_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE client (id INT AUTO_INCREMENT NOT NULL, person_id INT NOT NULL, email VARCHAR(150) NOT NULL, UNIQUE INDEX UNIQ_C7440455217BBB47 (person_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE closing_day (closing_date DATE NOT NULL, reason VARCHAR(255) NOT NULL, PRIMARY KEY(closing_date)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE member (id INT AUTO_INCREMENT NOT NULL, role_id INT NOT NULL, password VARCHAR(64) NOT NULL, username VARCHAR(50) NOT NULL, email VARCHAR(150) NOT NULL, UNIQUE INDEX UNIQ_70E4FA78E7927C74 (email), UNIQUE INDEX UNIQ_70E4FA78D60322AC (role_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payment (id INT AUTO_INCREMENT NOT NULL, ticket_order_id INT NOT NULL, payment_type VARCHAR(100) NOT NULL, date DATE NOT NULL, status VARCHAR(100) NOT NULL, INDEX IDX_6D28840D8F691B9 (ticket_order_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE person (id INT AUTO_INCREMENT NOT NULL, member_id INT DEFAULT NULL, firstname VARCHAR(150) NOT NULL, lastname VARCHAR(150) NOT NULL, date_of_birth DATE NOT NULL, profile_picture VARCHAR(255) DEFAULT NULL, UNIQUE INDEX UNIQ_34DCD1767597D3FE (member_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE role (id INT AUTO_INCREMENT NOT NULL, role_name VARCHAR(50) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE schedule_date (id INT AUTO_INCREMENT NOT NULL, date DATE NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket_order (id INT AUTO_INCREMENT NOT NULL, basket_id INT NOT NULL, date DATE NOT NULL, total_price NUMERIC(2, 0) NOT NULL, UNIQUE INDEX UNIQ_DD19F0131BE1FB52 (basket_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket_person (id INT AUTO_INCREMENT NOT NULL, person_id INT NOT NULL, ticket_type_id INT NOT NULL, UNIQUE INDEX UNIQ_4E9EBBBD217BBB47 (person_id), UNIQUE INDEX UNIQ_4E9EBBBDC980D5C1 (ticket_type_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('CREATE TABLE ticket_type (id INT AUTO_INCREMENT NOT NULL, type_name VARCHAR(50) NOT NULL, price NUMERIC(2, 0) NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
        $this->addSql('ALTER TABLE address ADD CONSTRAINT FK_D4E6F8119EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE basket ADD CONSTRAINT FK_2246507B19EB6921 FOREIGN KEY (client_id) REFERENCES client (id)');
        $this->addSql('ALTER TABLE basket_schedule_date ADD CONSTRAINT FK_48F5CCD01BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE basket_schedule_date ADD CONSTRAINT FK_48F5CCD035FD1ADA FOREIGN KEY (schedule_date_id) REFERENCES schedule_date (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE basket_ticket_person ADD CONSTRAINT FK_4CBD604C1BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE basket_ticket_person ADD CONSTRAINT FK_4CBD604CBB41610D FOREIGN KEY (ticket_person_id) REFERENCES ticket_person (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE client ADD CONSTRAINT FK_C7440455217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE member ADD CONSTRAINT FK_70E4FA78D60322AC FOREIGN KEY (role_id) REFERENCES role (id)');
        $this->addSql('ALTER TABLE payment ADD CONSTRAINT FK_6D28840D8F691B9 FOREIGN KEY (ticket_order_id) REFERENCES ticket_order (id)');
        $this->addSql('ALTER TABLE person ADD CONSTRAINT FK_34DCD1767597D3FE FOREIGN KEY (member_id) REFERENCES member (id)');
        $this->addSql('ALTER TABLE ticket_order ADD CONSTRAINT FK_DD19F0131BE1FB52 FOREIGN KEY (basket_id) REFERENCES basket (id)');
        $this->addSql('ALTER TABLE ticket_person ADD CONSTRAINT FK_4E9EBBBD217BBB47 FOREIGN KEY (person_id) REFERENCES person (id)');
        $this->addSql('ALTER TABLE ticket_person ADD CONSTRAINT FK_4E9EBBBDC980D5C1 FOREIGN KEY (ticket_type_id) REFERENCES ticket_type (id)');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->abortIf($this->connection->getDatabasePlatform()->getName() !== 'mysql', 'Migration can only be executed safely on \'mysql\'.');

        $this->addSql('ALTER TABLE basket_schedule_date DROP FOREIGN KEY FK_48F5CCD01BE1FB52');
        $this->addSql('ALTER TABLE basket_ticket_person DROP FOREIGN KEY FK_4CBD604C1BE1FB52');
        $this->addSql('ALTER TABLE ticket_order DROP FOREIGN KEY FK_DD19F0131BE1FB52');
        $this->addSql('ALTER TABLE address DROP FOREIGN KEY FK_D4E6F8119EB6921');
        $this->addSql('ALTER TABLE basket DROP FOREIGN KEY FK_2246507B19EB6921');
        $this->addSql('ALTER TABLE person DROP FOREIGN KEY FK_34DCD1767597D3FE');
        $this->addSql('ALTER TABLE client DROP FOREIGN KEY FK_C7440455217BBB47');
        $this->addSql('ALTER TABLE ticket_person DROP FOREIGN KEY FK_4E9EBBBD217BBB47');
        $this->addSql('ALTER TABLE member DROP FOREIGN KEY FK_70E4FA78D60322AC');
        $this->addSql('ALTER TABLE basket_schedule_date DROP FOREIGN KEY FK_48F5CCD035FD1ADA');
        $this->addSql('ALTER TABLE payment DROP FOREIGN KEY FK_6D28840D8F691B9');
        $this->addSql('ALTER TABLE basket_ticket_person DROP FOREIGN KEY FK_4CBD604CBB41610D');
        $this->addSql('ALTER TABLE ticket_person DROP FOREIGN KEY FK_4E9EBBBDC980D5C1');
        $this->addSql('DROP TABLE address');
        $this->addSql('DROP TABLE basket');
        $this->addSql('DROP TABLE basket_schedule_date');
        $this->addSql('DROP TABLE basket_ticket_person');
        $this->addSql('DROP TABLE client');
        $this->addSql('DROP TABLE closing_day');
        $this->addSql('DROP TABLE member');
        $this->addSql('DROP TABLE payment');
        $this->addSql('DROP TABLE person');
        $this->addSql('DROP TABLE role');
        $this->addSql('DROP TABLE schedule_date');
        $this->addSql('DROP TABLE ticket_order');
        $this->addSql('DROP TABLE ticket_person');
        $this->addSql('DROP TABLE ticket_type');
    }
}
