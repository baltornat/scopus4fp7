<?php

namespace app\models;

/**
 * This is the model class for table "publications.pub_author".
 *
 * @property int $pubid
 * @property string $authid
 * @property string|null $afid
 * @property int $id
 */
class PublicationsPubAuthor extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publications.pub_author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pubid', 'authid'], 'required'],
            [['pubid'], 'default', 'value' => null],
            [['pubid'], 'integer'],
            [['authid', 'afid'], 'string'],
            [['pubid', 'authid', 'afid'], 'unique', 'targetAttribute' => ['pubid', 'authid', 'afid']],
            [['afid'], 'exist', 'skipOnError' => true, 'targetClass' => PublicationsAffiliation::className(), 'targetAttribute' => ['afid' => 'afid']],
            [['authid'], 'exist', 'skipOnError' => true, 'targetClass' => PublicationsAuthor::className(), 'targetAttribute' => ['authid' => 'authid']],
            [['pubid'], 'exist', 'skipOnError' => true, 'targetClass' => PublicationsPublication::className(), 'targetAttribute' => ['pubid' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pubid' => 'Pubid',
            'authid' => 'Authid',
            'afid' => 'Afid',
            'id' => 'ID',
        ];
    }
}
