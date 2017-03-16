<?php

use yii\db\Migration;
use yii\db\Query;

class m170316_153814_alter_reports extends Migration
{
    public function safeUp()
    {
        $this->execute('ALTER TABLE xmp_providers ADD name_alias VARCHAR(255) NULL;');

        # Providers
//        $this->execute("INSERT INTO xmp_providers(name, id_country, name_alias) VALUES('cheese', 6, 'cheese');");
//        $this->execute("INSERT INTO xmp_providers(name, id_country, name_alias) VALUES('qrtech', 6, 'qrtech');");
//        $this->execute("INSERT INTO xmp_providers(name, id_country, name_alias) VALUES('beeline', 2, 'beeline');");
//        $this->execute("INSERT INTO xmp_providers(name, id_country, name_alias) VALUES('yondu', 9, 'yondu');");
        $this->execute("INSERT INTO xmp_providers(name, id_country, name_alias) VALUES('mobilink', 4, 'mobilink');");

        $query = (new Query())
            ->select('id')
            ->from('xmp_providers')
            ->where([
                'name_alias' => 'mobilink',
            ])
            ->one();

        $this->execute("INSERT INTO xmp_operators (name, id_provider, isp, msisdn_prefix, mcc, mnc, code) VALUES ('Mobilink', " . $query['id'] . ", NULL, '92', '410', '01',  41001);");


//        $this->execute("INSERT INTO xmp_operators (id, name, id_provider, isp, msisdn_prefix, mcc, mnc, created_at, status, code) VALUES (34, 'QR Tech', 66, NULL, NULL, NULL, NULL, '2017-03-08 16:19:02.102757', 1, 52991);");
//        $this->execute("INSERT INTO xmp_operators (id, name, id_provider, isp, msisdn_prefix, mcc, mnc, created_at, status, code) VALUES (35, 'Cheese Mobile', 66, NULL, NULL, NULL, NULL, '2017-03-08 16:19:17.568047', 1, 52992);");
//        $this->execute("INSERT INTO xmp_operators (id, name, id_provider, isp, msisdn_prefix, mcc, mnc, created_at, status, code) VALUES (26, 'H3I', 62, 'ISP', '898', '510', '89', '2016-06-07 08:41:11.479920', 1, 51089);");
//        $this->execute("INSERT INTO xmp_operators (id, name, id_provider, isp, msisdn_prefix, mcc, mnc, created_at, status, code) VALUES (30, 'DTAC', 66, 'Total Access (DTAC) ', '', '520', '05', '2016-07-05 17:06:14.809712', 1, 52005);");
//        $this->execute("INSERT INTO xmp_operators (id, name, id_provider, isp, msisdn_prefix, mcc, mnc, created_at, status, code) VALUES (33, 'TRUEH', 66, NULL, NULL, '520', '00', '2017-01-30 19:15:40.483008', 1, 52000);");
//        $this->execute("INSERT INTO xmp_operators (id, name, id_provider, isp, msisdn_prefix, mcc, mnc, created_at, status, code) VALUES (29, 'AIS', 66, 'AIS/Advanced Info Service ', '061, 062, 063, 0800, 0801, 0802, 0806, 0810, 0812, 0817, 0818, 0819, 082, 084, 087, 089, 090, 0901, 092', '520', '01', '2016-07-05 16:21:21.974771', 1, 52001);");
//        $this->execute("INSERT INTO xmp_operators (id, name, id_provider, isp, msisdn_prefix, mcc, mnc, created_at, status, code) VALUES (32, 'Yondu', 63, NULL, '', '515', '01', '2016-12-26 14:22:05.152148', 1, 51501);");
    }

    public function safeDown()
    {
        $this->truncateTable('xmp_providers');
        $this->truncateTable('xmp_operators');
        $this->execute('ALTER TABLE xmp_providers DROP name_alias;');
    }
}
