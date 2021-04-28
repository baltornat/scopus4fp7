<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%appschema.user}}`.
 */
class m210321_142003_create_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%appschema.user}}', [
            'id' => $this->string()->notNull()->unique(),
            'email' => $this->string(254)->notNull()->unique(),
            'password' => $this->string(128)->notNull(),
            'name' => $this->string()->notNull(),
            'surname' => $this->string()->notNull(),
            'authKey' => $this->string()->notNull(),
            'accessToken' => $this->string()->notNull(),
            'isDisabled' => $this->boolean()->defaultValue(false),
        ]);
        $this->addPrimaryKey('user_id', '{{%appschema.user}}', ['id']);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%appschema.user}}');
    }
}
