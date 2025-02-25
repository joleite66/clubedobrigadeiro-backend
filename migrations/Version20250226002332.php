<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250226002332 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE TABLE orders (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, subscription_id INT NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', delivery_date DATE NOT NULL, status VARCHAR(20) DEFAULT \'pending\' NOT NULL, INDEX IDX_E52FFDEEA76ED395 (user_id), INDEX IDX_E52FFDEE9A1887DC (subscription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE payments (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, subscription_id INT NOT NULL, amount NUMERIC(10, 2) NOT NULL, payment_method VARCHAR(50) NOT NULL, transaction_id VARCHAR(255) NOT NULL, status VARCHAR(20) DEFAULT \'pending\' NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_65D29B322FC0CB0F (transaction_id), INDEX IDX_65D29B32A76ED395 (user_id), INDEX IDX_65D29B329A1887DC (subscription_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE plans (id INT AUTO_INCREMENT NOT NULL, updated_by INT DEFAULT NULL, name VARCHAR(100) NOT NULL, price NUMERIC(10, 2) NOT NULL, duration INT DEFAULT 1 NOT NULL, max_orders INT DEFAULT 0 NOT NULL, is_active TINYINT(1) DEFAULT 1 NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_356798D15E237E06 (name), INDEX IDX_356798D116FE72E1 (updated_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE referrals (id INT AUTO_INCREMENT NOT NULL, referrer_id INT NOT NULL, referred_id INT NOT NULL, earned_points INT DEFAULT 10 NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', INDEX IDX_1B7DC896798C22DB (referrer_id), INDEX IDX_1B7DC896CFE2A98 (referred_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE rewards (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(100) NOT NULL, description VARCHAR(255) NOT NULL, months_required INT NOT NULL, points_required INT NOT NULL, is_active TINYINT(1) DEFAULT 1 NOT NULL, created_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE subscriptions (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, plan_id INT NOT NULL, start_date DATE NOT NULL, end_date DATE NOT NULL, status VARCHAR(20) DEFAULT \'active\' NOT NULL, INDEX IDX_4778A01A76ED395 (user_id), INDEX IDX_4778A01E899029B (plan_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE `user` (id INT AUTO_INCREMENT NOT NULL, referred_by INT DEFAULT NULL, first_name VARCHAR(100) NOT NULL, last_name VARCHAR(100) NOT NULL, email VARCHAR(180) NOT NULL, phone VARCHAR(20) NOT NULL, birthday DATE NOT NULL, password VARCHAR(255) NOT NULL, is_active TINYINT(1) DEFAULT 1 NOT NULL, is_verified TINYINT(1) DEFAULT 0 NOT NULL, roles JSON NOT NULL, total_subscription_months INT DEFAULT 0 NOT NULL, loyalty_points INT DEFAULT 0 NOT NULL, referral_code VARCHAR(10) NOT NULL, created_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', updated_at DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', UNIQUE INDEX UNIQ_8D93D649E7927C74 (email), UNIQUE INDEX UNIQ_8D93D649444F97DD (phone), UNIQUE INDEX UNIQ_8D93D6496447454A (referral_code), INDEX IDX_8D93D6498C0C9F8A (referred_by), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('CREATE TABLE user_rewards (id INT AUTO_INCREMENT NOT NULL, user_id INT NOT NULL, reward_id INT NOT NULL, earned_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\', status VARCHAR(20) DEFAULT \'pending\' NOT NULL, INDEX IDX_B12F003DA76ED395 (user_id), INDEX IDX_B12F003DE466ACA1 (reward_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEEA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE orders ADD CONSTRAINT FK_E52FFDEE9A1887DC FOREIGN KEY (subscription_id) REFERENCES subscriptions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payments ADD CONSTRAINT FK_65D29B32A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE payments ADD CONSTRAINT FK_65D29B329A1887DC FOREIGN KEY (subscription_id) REFERENCES subscriptions (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE plans ADD CONSTRAINT FK_356798D116FE72E1 FOREIGN KEY (updated_by) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE referrals ADD CONSTRAINT FK_1B7DC896798C22DB FOREIGN KEY (referrer_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE referrals ADD CONSTRAINT FK_1B7DC896CFE2A98 FOREIGN KEY (referred_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscriptions ADD CONSTRAINT FK_4778A01A76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE subscriptions ADD CONSTRAINT FK_4778A01E899029B FOREIGN KEY (plan_id) REFERENCES plans (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE `user` ADD CONSTRAINT FK_8D93D6498C0C9F8A FOREIGN KEY (referred_by) REFERENCES `user` (id)');
        $this->addSql('ALTER TABLE user_rewards ADD CONSTRAINT FK_B12F003DA76ED395 FOREIGN KEY (user_id) REFERENCES `user` (id) ON DELETE CASCADE');
        $this->addSql('ALTER TABLE user_rewards ADD CONSTRAINT FK_B12F003DE466ACA1 FOREIGN KEY (reward_id) REFERENCES rewards (id) ON DELETE CASCADE');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEEA76ED395');
        $this->addSql('ALTER TABLE orders DROP FOREIGN KEY FK_E52FFDEE9A1887DC');
        $this->addSql('ALTER TABLE payments DROP FOREIGN KEY FK_65D29B32A76ED395');
        $this->addSql('ALTER TABLE payments DROP FOREIGN KEY FK_65D29B329A1887DC');
        $this->addSql('ALTER TABLE plans DROP FOREIGN KEY FK_356798D116FE72E1');
        $this->addSql('ALTER TABLE referrals DROP FOREIGN KEY FK_1B7DC896798C22DB');
        $this->addSql('ALTER TABLE referrals DROP FOREIGN KEY FK_1B7DC896CFE2A98');
        $this->addSql('ALTER TABLE subscriptions DROP FOREIGN KEY FK_4778A01A76ED395');
        $this->addSql('ALTER TABLE subscriptions DROP FOREIGN KEY FK_4778A01E899029B');
        $this->addSql('ALTER TABLE `user` DROP FOREIGN KEY FK_8D93D6498C0C9F8A');
        $this->addSql('ALTER TABLE user_rewards DROP FOREIGN KEY FK_B12F003DA76ED395');
        $this->addSql('ALTER TABLE user_rewards DROP FOREIGN KEY FK_B12F003DE466ACA1');
        $this->addSql('DROP TABLE orders');
        $this->addSql('DROP TABLE payments');
        $this->addSql('DROP TABLE plans');
        $this->addSql('DROP TABLE referrals');
        $this->addSql('DROP TABLE rewards');
        $this->addSql('DROP TABLE subscriptions');
        $this->addSql('DROP TABLE `user`');
        $this->addSql('DROP TABLE user_rewards');
    }
}
