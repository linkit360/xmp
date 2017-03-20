<?php

use yii\db\Migration;

class m170320_091830_create_transactions extends Migration
{
    public function safeUp()
    {
        /*
             $this->execute('


     CREATE TABLE xmp_transactions_results ( name VARCHAR(127) NOT NULL PRIMARY KEY );
     INSERT INTO xmp_transactions_results VALUES
       (\'failed\'),
       (\'sms\'),
       (\'paid\'),
       (\'retry_failed\'),
       (\'retry_paid\'),
       (\'rejected\'),
       (\'expired_paid\'),
       (\'expired_failed\'),
       (\'injection_paid\'),
       (\'injection_failed\');
     CREATE TABLE xmp_transactions
     (
       id SERIAL PRIMARY KEY NOT NULL,
       created_at TIMESTAMP DEFAULT now(),
       sent_at TIMESTAMP NOT NULL DEFAULT NOW(),
       tid CHARACTER VARYING(127) NOT NULL DEFAULT \'\',
       msisdn VARCHAR(32) NOT NULL,
       country_code INTEGER NOT NULL DEFAULT 0,
       id_service INTEGER NOT NULL DEFAULT 0,
       id_campaign INTEGER DEFAULT 0 NOT NULL,
       operator_code INTEGER NOT NULL DEFAULT 0,
       id_subscription INTEGER NOT NULL DEFAULT 0,
       id_content INTEGER NOT NULL DEFAULT 0,
       operator_token VARCHAR(511) NOT NULL,
       price INTEGER NOT NULL,
       result VARCHAR(127) NOT NULL,
       CONSTRAINT xmp_transactions_result_fk FOREIGN KEY (result) REFERENCES xmp_transactions_results (name)
     );
     CREATE INDEX xmp_transactions_sent_at_idx
       ON xmp_transactions(sent_at);
     CREATE INDEX xmp_transactions_msisdn_idx
       ON xmp_transactions(msisdn);
     CREATE INDEX xmp_transactions_result_idx
       ON xmp_transactions(result);
     CREATE INDEX xmp_transactions_operator_token_idx
       ON xmp_transactions(operator_token);

      ');
             */
    }

    public function safeDown()
    {
        $this->dropTable('xmp_transactions');
    }
}
