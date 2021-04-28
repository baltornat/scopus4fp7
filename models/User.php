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
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'appschema.user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['email', 'password', 'name', 'surname'], 'required'],
            [['email'], 'string', 'max' => 254],
            [['password'], 'string', 'min' => 4, 'max' => 128],
            [['id', 'name', 'surname', 'authKey', 'accessToken'], 'string', 'max' => 255],
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
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'name' => 'Name',
            'surname' => 'Surname',
            'isDisabled' => 'Is Disabled',
        ];
    }

    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type=null)
    {
        return self::findOne(['accessToken'=>$token]);
    }

    public static function findByEmail($email)
    {
        return self::findOne(['email' => $email]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
        return password_verify($password, $this->password);
    }

    public function getAuthAssignment(){
        return $this->hasOne(AuthAssignment::className(), ['user_id'=>'id']);
    }

}
