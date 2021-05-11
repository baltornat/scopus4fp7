<?php

namespace app\models;


/**
 * This is the model class for table "authors.project_ppi".
 *
 * @property int $id
 * @property string|null $p_rcn
 * @property string|null $funding_scheme
 * @property string|null $call_year
 * @property string|null $ppi_firstname
 * @property string|null $ppi_lastname
 * @property string|null $organization_url
 * @property string|null $ppi_organization
 * @property string|null $erc_field
 * @property string|null $p_id
 */
class AuthorsProjectPpi extends \yii\db\ActiveRecord
{
    public $num_projects;
    public $num_projects2;
    public $num_authors;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors.project_ppi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['p_rcn', 'ppi_firstname', 'ppi_lastname', 'organization_url', 'ppi_organization', 'erc_field', 'p_id'], 'string'],
            [['funding_scheme'], 'string', 'max' => 7],
            [['call_year'], 'string', 'max' => 4],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'p_rcn' => 'P Rcn',
            'funding_scheme' => 'Funding scheme',
            'call_year' => 'Call year',
            'ppi_firstname' => 'Ppi firstname',
            'ppi_lastname' => 'Ppi lastname',
            'organization_url' => 'Organization url',
            'ppi_organization' => 'Ppi Organization',
            'erc_field' => 'Erc field',
            'p_id' => 'P ID',
        ];
    }

    public function getPpiOrganization(){
        return $this->hasOne(CordisCordisProject::className(), ['p_rcn'=>'p_rcn']);
    }

    public function getMappingErcScopus(){
        return $this->hasOne(AuthorsMappingErcScopus::className(), ['erc_field'=>'erc_field']);
    }

}
