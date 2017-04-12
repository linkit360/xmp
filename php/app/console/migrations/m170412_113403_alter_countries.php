<?php

use yii\db\Migration;

class m170412_113403_alter_countries extends Migration
{
    public function safeUp()
    {
        $this->execute("ALTER TABLE xmp_countries ADD flag VARCHAR(64) DEFAULT 'Unknown' NOT NULL;");
        $this->execute("ALTER TABLE xmp_countries ADD currency VARCHAR(32) DEFAULT '' NOT NULL;");
    }

    public function safeDown()
    {
        $this->execute("ALTER TABLE xmp_countries DROP flag;");
        $this->execute("ALTER TABLE xmp_countries DROP currency;");
    }
}
