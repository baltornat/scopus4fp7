<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $nome
 * @property string $cognome
 * @property string|null $auth_key
 * @property bool|null $is_disabled
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
            [['email', 'password', 'nome', 'cognome'], 'required'],
            ['email', 'email'],
            [['is_disabled'], 'boolean'],
            [['email', 'password', 'nome', 'cognome', 'auth_key'], 'string', 'max' => 255],
            [['email'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'nome' => 'Nome',
            'cognome' => 'Cognome',
            'auth_key' => 'Auth Key',
            'is_disabled' => 'Is Disabled',
        ];
    }
}
