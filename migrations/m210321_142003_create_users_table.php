<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 */
class m210321_142003_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'email' => $this->string(80)->notNull()->unique(),
            'password' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'authKey' => $this->string()->notNull(),
            'accessToken' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%users}}');
    }
}
