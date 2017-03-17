<?php
use yii\db\Migration;

class m170317_131626_create_msisdn_blacklist extends Migration
{
    public function safeUp()
    {
        $this->execute('CREATE TABLE xmp_msisdn_blacklist
                            (
                                id SERIAL PRIMARY KEY NOT NULL,
                                msisdn VARCHAR(32),
                                provider_name VARCHAR(255) NOT NULL,
                                operator_code INT NOT NULL,
                                created_at TIMESTAMP DEFAULT now()
                            );
                        ');
    }

    public function safeDown()
    {
        $this->dropTable('xmp_msisdn_blacklist');
    }
}
