<?php

use yii\db\Migration;

class m170322_105558_create_users extends Migration
{
    public function safeUp()
    {
        $this->execute('CREATE TABLE xmp_users
                            (
                              id                   UUID PRIMARY KEY DEFAULT public.uuid_generate_v4() NOT NULL,
                              username             VARCHAR(255)                                       NOT NULL,
                              auth_key             VARCHAR(32)                                        NOT NULL,
                              password_hash        VARCHAR(255)                                       NOT NULL,
                              password_reset_token VARCHAR(255),
                              email                VARCHAR(255)                                       NOT NULL,
                              status               SMALLINT DEFAULT 1                                 NOT NULL,
                              created_at           INTEGER                                            NOT NULL,
                              updated_at           INTEGER                                            NOT NULL
                            );
                      ');
    }

    public function safeDown()
    {
        $this->dropTable('xmp_users');
    }
}
