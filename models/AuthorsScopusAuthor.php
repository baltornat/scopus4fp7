<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors.scopus_author".
 *
 * @property int $id
 * @property int|null $project_ppi
 * @property string|null $author_scopus_id
 * @property string|null $firstname
 * @property string|null $lastname
 * @property string|null $affil_id
 * @property string|null $affil_name
 * @property string|null $affil_city
 * @property string|null $affil_country
 * @property int|null $num_documents
 * @property string|null $author_modality
 */
class AuthorsScopusAuthor extends \yii\db\ActiveRecord
{
    public $num_modality;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors.scopus_author';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['project_ppi', 'num_documents', 'affil_name', 'affil_city', 'affil_country'], 'default', 'value' => null],
            [['project_ppi', 'num_documents'], 'integer'],
            [['project_ppi', 'author_scopus_id', 'firstname', 'lastname'], 'required'],
            [['author_scopus_id', 'firstname', 'lastname', 'affil_id', 'affil_name', 'affil_city', 'affil_country', 'author_modality'], 'string'],
            [['project_ppi', 'author_scopus_id'], 'unique', 'targetAttribute' => ['project_ppi', 'author_scopus_id']],
            [['project_ppi'], 'exist', 'skipOnError' => true, 'targetClass' => AuthorsProjectPpi::className(), 'targetAttribute' => ['project_ppi' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'project_ppi' => 'Project Ppi',
            'author_scopus_id' => 'Author Scopus ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'affil_id' => 'Affiliate ID',
            'affil_name' => 'Affiliate name',
            'affil_city' => 'Affiliate city',
            'affil_country' => 'Affiliate country',
            'num_documents' => 'Number of documents',
            'author_modality' => 'Author modality',
        ];
    }

    public function getAuthorSubjectArea(){
        return $this->hasMany(AuthorsAuthorSubjectArea::className(), ['author_id'=>'id']);
    }

    public function getProjectAuthorMatch(){
        return $this->hasOne(AuthorsProjectAuthorMatch::className(), ['author_scopus_id'=>'author_scopus_id', 'project_ppi'=>'project_ppi']);
    }
}
