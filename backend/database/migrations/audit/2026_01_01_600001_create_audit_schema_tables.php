<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. NOTIFICATIONS_LOG
        DB::statement("
            CREATE TABLE notifications_log (
                id BIGINT UNSIGNED AUTO_INCREMENT,
                public_id VARCHAR(36) NOT NULL DEFAULT (UUID()),
                tenant_id BIGINT UNSIGNED NULL,
                recipient_user_id BIGINT UNSIGNED NOT NULL,
                channel VARCHAR(50) NOT NULL,
                template_code VARCHAR(100) NOT NULL,
                related_entity_type VARCHAR(100) NULL,
                related_entity_id BIGINT UNSIGNED NULL,
                status VARCHAR(50) NOT NULL,
                subject VARCHAR(255) NULL,
                body TEXT NOT NULL,
                provider_message_id VARCHAR(255) NULL,
                sent_at DATETIME NULL,
                created_by BIGINT UNSIGNED NOT NULL,
                updated_by BIGINT UNSIGNED NULL,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id, created_at),
                UNIQUE KEY uk_notifications_public_id (public_id, created_at)
            ) ENGINE=InnoDB
            PARTITION BY RANGE COLUMNS(created_at) (
                PARTITION p2026_09 VALUES LESS THAN ('2026-10-01 00:00:00'),
                PARTITION p2026_10 VALUES LESS THAN ('2026-11-01 00:00:00'),
                PARTITION p2026_11 VALUES LESS THAN ('2026-12-01 00:00:00'),
                PARTITION p_future VALUES LESS THAN (MAXVALUE)
            );
        ");

        // 2. DATA_CHANGE_LOGS
        DB::statement("
            CREATE TABLE data_change_logs (
                id BIGINT UNSIGNED AUTO_INCREMENT,
                public_id VARCHAR(36) NOT NULL DEFAULT (UUID()),
                tenant_id BIGINT UNSIGNED NULL,
                actor_user_id BIGINT UNSIGNED NULL,
                table_name VARCHAR(100) NOT NULL,
                record_id BIGINT UNSIGNED NOT NULL,
                action VARCHAR(20) NOT NULL,
                old_values JSON NULL,
                new_values JSON NULL,
                ip_address VARCHAR(45) NULL,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id, created_at),
                UNIQUE KEY uk_data_change_public_id (public_id, created_at)
            ) ENGINE=InnoDB
            PARTITION BY RANGE COLUMNS(created_at) (
                PARTITION p2026_09 VALUES LESS THAN ('2026-10-01 00:00:00'),
                PARTITION p2026_10 VALUES LESS THAN ('2026-11-01 00:00:00'),
                PARTITION p2026_11 VALUES LESS THAN ('2026-12-01 00:00:00'),
                PARTITION p_future VALUES LESS THAN (MAXVALUE)
            );
        ");

        // 3. AUTHENTICATION_LOGS
        DB::statement("
            CREATE TABLE authentication_logs (
                id BIGINT UNSIGNED AUTO_INCREMENT,
                public_id VARCHAR(36) NOT NULL DEFAULT (UUID()),
                tenant_id BIGINT UNSIGNED NULL,
                user_id BIGINT UNSIGNED NULL,
                email_attempted VARCHAR(255) NOT NULL,
                event VARCHAR(50) NOT NULL,
                auth_method VARCHAR(50) NOT NULL,
                ip_address VARCHAR(45) NULL,
                user_agent TEXT NULL,
                failure_reason VARCHAR(255) NULL,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id, created_at),
                UNIQUE KEY uk_auth_logs_public_id (public_id, created_at)
            ) ENGINE=InnoDB
            PARTITION BY RANGE COLUMNS(created_at) (
                PARTITION p2026_09 VALUES LESS THAN ('2026-10-01 00:00:00'),
                PARTITION p2026_10 VALUES LESS THAN ('2026-11-01 00:00:00'),
                PARTITION p2026_11 VALUES LESS THAN ('2026-12-01 00:00:00'),
                PARTITION p_future VALUES LESS THAN (MAXVALUE)
            );
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP TABLE IF EXISTS authentication_logs;");
        DB::statement("DROP TABLE IF EXISTS data_change_logs;");
        DB::statement("DROP TABLE IF EXISTS notifications_log;");
    }
};
