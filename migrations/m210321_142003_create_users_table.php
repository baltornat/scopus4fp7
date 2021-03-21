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
            'email' => $this->primaryKey(),
            'password' => $this->string()->notNull(),
            'nome' => $this->string()->notNull(),
            'cognome' => $this->string()->notNull(),
            'auth_key' => $this->string(),
            'is_disabled' => $this->boolean()->defaultValue(0),
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
