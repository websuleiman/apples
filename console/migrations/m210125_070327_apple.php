<?php

use yii\db\Migration;

/**
 * Class m210125_070327_apple
 */
class m210125_070327_apple extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('apple', [
            'id' => $this->primaryKey(),
            'color' => $this->string(50)->notNull(),
            'status' => $this->tinyInteger(4)->defaultValue(0),
            'size' => $this->decimal(2.1),
            'create_time' => $this->timestamp(),
            'drop_time' => $this->timestamp(),
        ]);

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m210125_070327_apple cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m210125_070327_apple cannot be reverted.\n";

        return false;
    }
    */
}
