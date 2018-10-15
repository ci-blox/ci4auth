<?php namespace App\Database\Migration;

use CodeIgniter\Database\Migration;

class Migration_create_auth_tables extends Migration
{
    public function up()
    {
        /*
         * Auth Users
         */
        $this->forge->addField([
            'id'               => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'email'            => ['type' => 'varchar', 'constraint' => 255],
            'password'    => ['type' => 'varchar', 'constraint' => 255],
            'isactive'          => ['type' => 'tinyint', 'constraint' => 1, 'null' => 0, 'default' => 0],
            'firstName'         => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
            'lastName'          => ['type' => 'varchar', 'constraint' => 50, 'null' => true],
            'dt'                => ['type' => 'timestamp', 'null' => false, 'default' => 'CURRENT TIMESTAMP']
        ]);

        $this->forge->addKey('id', true);
        $this->forge->addKey('email');

        $this->forge->createTable('auth_users', true);

        /*
         * Auth Attempts
         *
        `id` INT(11) NOT NULL AUTO_INCREMENT,
    	`ip` CHAR(39) NOT NULL,
    	`expiredate` DATETIME NOT NULL,
    	PRIMARY KEY (`id`),
    	INDEX `ip` (`ip`)
         */
        $this->forge->addField([
          'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
          'ip' => ['type' => 'varchar', 'constraint' => 39, 'null' => true],
          'expiredate'       => ['type' => 'datetime']
        ]);
        $this->forge->addKey('id', true);

        $this->forge->createTable('auth_attempts', true);

        /*
         * Auth Emails Banned
             `id` INT(11) NOT NULL AUTO_INCREMENT,
            `domain` VARCHAR(100) NULL DEFAULT NULL,
            PRIMARY KEY (`id`)
         */
        $this->forge->addField([
          'id'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
          'domain' => ['type' => 'varchar', 'constraint' => 100, 'null' => true, 'default' => null]
        ]);
        $this->forge->addKey('id', true);

        $this->forge->createTable('auth_emails_banned', true);

        /*
         * Auth Requests
            `id` INT(11) NOT NULL AUTO_INCREMENT,
            `uid` INT(11) NOT NULL,
            `token` CHAR(20) NOT NULL COLLATE 'latin1_general_ci',
            `expire` DATETIME NOT NULL,
            `type` ENUM('activation','reset') NOT NULL COLLATE 'latin1_general_ci',
            PRIMARY KEY (`id`),
            INDEX `type` (`type`),
            INDEX `token` (`token`),
            INDEX `uid` (`uid`)
         */
        $this->forge->addField([
            'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'uid'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true],
            'token'       => ['type' => 'varchar', 'constraint' => 20],
            'expire'      => ['type' => 'datetime'],
            'type'        => ['type' => "('activation','reset')", 'null' => false]
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addKey('token');
        $this->forge->addKey('type');
        $this->forge->addForeignKey('uid', 'users', 'id', false, 'CASCADE');
        $this->forge->createTable('auth_requests', true);

        /*
         * Auth Sessions
        	`id` INT(11) NOT NULL AUTO_INCREMENT,
            `uid` INT(11) NOT NULL,
            `hash` CHAR(40) NOT NULL COLLATE 'latin1_general_ci',
            `expiredate` DATETIME NOT NULL,
            `ip` VARCHAR(39) NOT NULL,
            `agent` VARCHAR(200) NOT NULL,
            `cookie_crc` CHAR(40) NOT NULL COLLATE 'latin1_general_ci',
            PRIMARY KEY (`id`)
            *
         */
        $this->forge->addField([
            'id'          => ['type' => 'int', 'constraint' => 11, 'unsigned' => true, 'auto_increment' => true],
            'uid'         => ['type' => 'int', 'constraint' => 11, 'unsigned' => true ],
            'hash'       => ['type' => 'char', 'constraint' => 40],
            'expiredate' => ['type' => 'datetime', 'null' => false],
            'ip'         => ['type' => 'varchar', 'constraint' => 39, 'null' => false],
            'agent'      => ['type' => 'varchar', 'constraint' => 200, 'null' => false],
            'cookie_crc' => ['type' => 'varchar', 'constraint' => 40, , 'null' => false],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('uid', 'users', 'id', false, 'CASCADE');
        $this->forge->createTable('auth_sessions');
    }

    //--------------------------------------------------------------------

    public function down()
    {
        $this->forge->dropTable('auth_users', true);
        $this->forge->dropTable('auth_attempts', true);
        $this->forge->dropTable('auth_emails_banned', true);
        $this->forge->dropTable('auth_requests', true);
        $this->forge->dropTable('auth_sessions', true);
    }
}
