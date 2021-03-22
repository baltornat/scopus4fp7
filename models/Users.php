<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $surname
 * @property string $authKey
 * @property string $accessToken
 */
class Users extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password', 'name', 'surname'], 'required'],
            [['email'], 'string', 'max' => 80],
            [['password', 'name', 'surname', 'authKey', 'accessToken'], 'string', 'max' => 255],
            [['email'], 'unique'],
            [['email'], 'email'],
            [['isDisabled'], 'boolean'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'email' => 'Email',
            'password' => 'Password',
            'name' => 'Name',
            'surname' => 'Surname',
        ];
    }
}
