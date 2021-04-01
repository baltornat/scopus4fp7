<?php

use yii\db\Migration;

/**
 * Class m210322_164134_init_rbac
 */
class m210401_111129_init_rbac extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function up()
    {
        $auth = Yii::$app->authManager;

        // add "manageProject" permission
        $manageProject = $auth->createPermission('manageProject');
        $manageProject->description = 'Manage a project';
        $auth->add($manageProject);

        // add "manageUser" permission
        $manageUser = $auth->createPermission('manageUser');
        $manageUser->description = 'Manage a user';
        $auth->add($manageUser);

        // add "manager" role and give this role the "manageProject" permission
        $manager = $auth->createRole('manager');
        $auth->add($manager);
        $auth->addChild($manager, $manageProject);

        // add "admin" role and give this role the "manageUser" permission
        // as well as the permissions of the "manager" role
        $admin = $auth->createRole('admin');
        $auth->add($admin);
        $auth->addChild($admin, $manageUser);
        $auth->addChild($admin, $manager);
    }

    /**
     * {@inheritdoc}
     */
    public function down()
    {
        $auth = Yii::$app->authManager;

        $auth->removeAll();
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function safeUp()
    {

    }

    public function safeDown()
    {
        echo "m210322_164134_init_rbac cannot be reverted.\n";

        return false;
    }
    */
}
