<?php

namespace app\models;

/**
 * This is the model class for table "authors.author_subject_area".
 *
 * @property int $author_id
 * @property string $area_short_name
 * @property int|null $area_frequency
 * @property string|null $area_long_name
 */
class AuthorsAuthorSubjectArea extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors.author_subject_area';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['author_id', 'area_short_name'], 'required'],
            [['author_id', 'area_frequency'], 'default', 'value' => null],
            [['author_id', 'area_frequency'], 'integer'],
            [['area_short_name', 'area_long_name'], 'string'],
            [['author_id', 'area_short_name'], 'unique', 'targetAttribute' => ['author_id', 'area_short_name']],
            [['author_id'], 'exist', 'skipOnError' => true, 'targetClass' => AuthorsScopusAuthor::className(), 'targetAttribute' => ['author_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'author_id' => 'Author ID',
            'area_short_name' => 'Area Short Name',
            'area_frequency' => 'Area Frequency',
            'area_long_name' => 'Area Long Name',
        ];
    }
}
