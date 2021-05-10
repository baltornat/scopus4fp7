<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publications.publication".
 *
 * @property int $id
 * @property string|null $eid
 * @property string|null $doi
 * @property string|null $title
 * @property int|null $citedby
 * @property string|null $issn
 * @property string|null $eissn
 * @property string|null $pubdate
 * @property string|null $pubdate_text
 * @property string|null $pubname
 * @property string|null $pubtype
 * @property string|null $funding_agency_acronym
 * @property string|null $funding_agency_id
 * @property string|null $funding_agency_name
 * @property string|null $citedby_link
 * @property string|null $author_scopus_id
 * @property int|null $project_ppi
 */
class PublicationsPublication extends \yii\db\ActiveRecord
{
    public $authors;
    public $keywords;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publications.publication';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['eid', 'doi', 'title', 'issn', 'eissn', 'pubdate_text', 'pubname', 'pubtype', 'funding_agency_acronym', 'funding_agency_id', 'funding_agency_name', 'citedby_link', 'author_scopus_id'], 'string'],
            [['citedby', 'project_ppi'], 'default', 'value' => null],
            [['citedby', 'project_ppi'], 'integer'],
            [['pubdate', 'authors', 'keywords'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'eid' => 'Eid',
            'doi' => 'Doi',
            'title' => 'Title',
            'citedby' => 'Citedby',
            'issn' => 'Issn',
            'eissn' => 'Eissn',
            'pubdate' => 'Pubdate',
            'pubdate_text' => 'Pubdate Text',
            'pubname' => 'Pubname',
            'pubtype' => 'Pubtype',
            'funding_agency_acronym' => 'Funding Agency Acronym',
            'funding_agency_id' => 'Funding Agency ID',
            'funding_agency_name' => 'Funding Agency Name',
            'citedby_link' => 'Citedby Link',
            'author_scopus_id' => 'Author Scopus ID',
            'project_ppi' => 'Project Ppi',
        ];
    }

    public function getPublicationsAuthor() {
        return $this->hasMany(PublicationsAuthor::className(), ['authid' => 'authid'])
            ->viaTable('publications.pub_author', ['pubid' => 'id']);
    }

    public function getPublicationsAbstract() {
        return $this->hasOne(PublicationsAbstract::className(), ['pubid' => 'id']);
    }

    public function getPublicationsKeyword() {
        return $this->hasMany(PublicationsKeyword::className(), ['pubid' => 'id']);
    }

    public function getPublicationsAffiliation() {
        return $this->hasMany(PublicationsAffiliation::className(), ['afid' => 'afid'])
            ->viaTable('publications.pub_author', ['pubid' => 'id']);
    }
}
