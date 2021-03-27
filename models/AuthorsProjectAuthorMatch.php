<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors.project_author_match".
 *
 * @property int $project_ppi
 * @property string $author_scopus_id
 * @property string $erc_field
 * @property float $match_value
 */
class AuthorsProjectAuthorMatch extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors.project_author_match';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_ppi', 'author_scopus_id', 'erc_field', 'match_value'], 'required'],
            [['project_ppi'], 'default', 'value' => null],
            [['project_ppi'], 'integer'],
            [['author_scopus_id', 'erc_field'], 'string'],
            [['match_value'], 'number'],
            [['project_ppi', 'author_scopus_id'], 'unique', 'targetAttribute' => ['project_ppi', 'author_scopus_id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'project_ppi' => 'Project Ppi',
            'author_scopus_id' => 'Author Scopus ID',
            'erc_field' => 'Erc Field',
            'match_value' => 'Match Value',
        ];
    }
}
