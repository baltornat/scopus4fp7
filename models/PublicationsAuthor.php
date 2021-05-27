<?php

namespace app\models;

/**
 * This is the model class for table "publications.author".
 *
 * @property string $authid
 * @property string|null $authname
 * @property string|null $authsurname
 * @property string|null $given_name
 */
class PublicationsAuthor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publications.author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['authid'], 'required'],
            [['authid', 'authname', 'authsurname', 'given_name'], 'string'],
            [['authid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'authid' => 'Authid',
            'authname' => 'Authname',
            'authsurname' => 'Authsurname',
            'given_name' => 'Given Name',
        ];
    }
}
