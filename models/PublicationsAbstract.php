<?php

namespace app\models;

/**
 * This is the model class for table "publications.abstract".
 *
 * @property int $pubid
 * @property string $language
 * @property string|null $content
 */
class PublicationsAbstract extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publications.abstract';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pubid', 'language'], 'required'],
            [['pubid'], 'default', 'value' => null],
            [['pubid'], 'integer'],
            [['language', 'content'], 'string'],
            [['pubid', 'language'], 'unique', 'targetAttribute' => ['pubid', 'language']],
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
            'language' => 'Language',
            'content' => 'Content',
        ];
    }
}
