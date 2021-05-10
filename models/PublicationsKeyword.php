<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publications.keyword".
 *
 * @property int $pubid
 * @property string $keyword
 * @property string $language
 */
class PublicationsKeyword extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publications.keyword';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pubid', 'keyword', 'language'], 'required'],
            [['pubid'], 'default', 'value' => null],
            [['pubid'], 'integer'],
            [['keyword', 'language'], 'string'],
            [['pubid', 'keyword', 'language'], 'unique', 'targetAttribute' => ['pubid', 'keyword', 'language']],
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
            'keyword' => 'Keyword',
            'language' => 'Language',
        ];
    }
}
