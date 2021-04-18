<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors.mapping_erc_scopus".
 *
 * @property string $erc_field
 * @property string $scopus_area
 * @property float|null $relevance
 */
class AuthorsMappingErcScopus extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors.mapping_erc_scopus';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['erc_field', 'scopus_area'], 'required'],
            [['erc_field', 'scopus_area'], 'string'],
            [['relevance'], 'number'],
            [['erc_field', 'scopus_area'], 'unique', 'targetAttribute' => ['erc_field', 'scopus_area']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'erc_field' => 'Erc Field',
            'scopus_area' => 'Scopus Area',
            'relevance' => 'Relevance',
        ];
    }

    public function getProjectPpi(){
        return $this->hasOne(AuthorsProjectPpi::className(), ['erc_field'=>'erc_field']);
    }

    public function getAuthorSubjectArea(){
        return $this->hasOne(AuthorsAuthorSubjectArea::className(), ['area_short_name'=>'scopus_area']);
    }
}
