<?php
// @codingStandardsIgnoreStart

use yii\db\Migration;

/**
 * Class m210433_183353_add_admin_user
 */
class m210433_183353_add_admin_user extends Migration
{
    // @codingStandardsIgnoreEnd

    /**
     * Table name
     *
     * @var string
     */
    private $_user = "{{%appschema.user}}";

    /**
     * Runs for the migrate/up command
     *
     * @return null
     */
    public function safeUp()
    {
        $email = Yii::$app->params['adminDefaultEmail'];
        $password = password_hash(Yii::$app->params['adminDefaultPassword'], PASSWORD_ARGON2I);
        $name = Yii::$app->params['adminDefaultName'];
        $surname = Yii::$app->params['adminDefaultSurname'];
        $authKey = md5(random_bytes(5));;
        $accessToken = password_hash(random_bytes(10), PASSWORD_DEFAULT);
        $table = $this->_user;

        $sql = <<<SQL
        INSERT INTO {$table}
        ("id", "email", "password", "name", "surname", "authKey", "accessToken", "isDisabled")
        VALUES
        ('1', '$email', '$password', '$name', '$surname', '$authKey', '$accessToken', false)
SQL;
        Yii::$app->db->createCommand($sql)->execute();
        $auth = Yii::$app->authManager;
        $admin = $auth->getRole('admin');
        $auth->assign($admin, '1');

    }

    /**
     * Runs for the migate/down command
     *
     * @return null
     */
    public function safeDown()
    {
        $table = $this->_user;
        $email = Yii::$app->params['adminDefaultEmail'];
        $sql = <<<SQL
        SELECT id from {$table}
        where email='$email'
SQL;
        $id = Yii::$app->db->createCommand($sql)->execute();
        $this->delete($this->_user, ['email' => $email]);
    }
}
