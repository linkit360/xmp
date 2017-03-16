<?php

use yii\db\Migration;

class m170316_113014_create_providers extends Migration
{
    public function safeUp()
    {
        $this->execute("CREATE TABLE xmp_providers
                            (
                                id SERIAL PRIMARY KEY NOT NULL,
                                name VARCHAR(255) NOT NULL,
                                country INT NOT NULL
                            );
                        ");

        $this->execute("CREATE UNIQUE INDEX xmp_providers_name_uindex ON xmp_providers (name);");
        $this->execute("COMMENT ON TABLE public.xmp_providers IS 'Providers';");
    }

    public function safeDown()
    {
        $this->dropTable('xmp_providers');
    }
}
