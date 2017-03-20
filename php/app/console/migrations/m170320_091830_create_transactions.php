<?php

use yii\db\Migration;

class m170320_091830_create_transactions extends Migration
{
    public function safeUp()
    {
        $this->execute('CREATE TABLE xmp_transactions_results (name VARCHAR(127) NOT NULL PRIMARY KEY);');
        $this->execute("INSERT INTO xmp_transactions_results VALUES
                           ('failed'),
                           ('sms'),
                           ('paid'),
                           ('retry_failed'),
                           ('retry_paid'),
                           ('rejected'),
                           ('expired_paid'),
                           ('expired_failed'),
                           ('injection_paid'),
                           ('injection_failed');");

        $this->execute("CREATE TABLE xmp_transactions
                            (
                              id              UUID PRIMARY KEY   NOT NULL   DEFAULT public.uuid_generate_v4(),
                              created_at      TIMESTAMP          NOT NULL   DEFAULT NOW(),
                              sent_at         TIMESTAMP          NOT NULL   DEFAULT NOW(),
                              tid             VARCHAR(127)       NOT NULL   DEFAULT '',
                              msisdn          VARCHAR(32)        NOT NULL,
                              id_country      INTEGER            NOT NULL   DEFAULT 0,
                              id_service      INTEGER            NOT NULL   DEFAULT 0,
                              id_campaign     INTEGER DEFAULT 0  NOT NULL,
                              id_subscription INTEGER            NOT NULL   DEFAULT 0,
                              id_content      INTEGER            NOT NULL   DEFAULT 0,
                              id_operator     INTEGER            NOT NULL   DEFAULT 0,
                              operator_token  VARCHAR(511)       NOT NULL,
                              price           INTEGER            NOT NULL,
                              result          VARCHAR(127)       NOT NULL,
                              CONSTRAINT xmp_transactions_result_fk FOREIGN KEY (result) REFERENCES xmp_transactions_results (name)
                            );
                      ");
    }

    public function safeDown()
    {
        $this->dropTable('xmp_transactions');
        $this->dropTable('xmp_transactions_results');
    }
}
