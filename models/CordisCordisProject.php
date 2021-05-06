<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cordis.cordis_project".
 *
 * @property int $id
 * @property string|null $p_id
 * @property string|null $p_rcn
 * @property string|null $acronym
 * @property string|null $funding_scheme
 * @property string|null $call_year
 * @property string|null $ppi_firstname
 * @property string|null $ppi_lastname
 * @property string|null $ppi_organization
 * @property string|null $organization_url
 * @property string|null $call_string
 * @property float|null $total_cost
 * @property string|null $erc_field
 * @property bool|null $is_beneficiary
 */
class CordisCordisProject extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cordis.cordis_project';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['p_id', 'p_rcn', 'acronym', 'ppi_firstname', 'ppi_lastname', 'ppi_organization', 'organization_url', 'call_string', 'erc_field'], 'string'],
            [['total_cost'], 'number'],
            [['is_beneficiary'], 'boolean'],
            [['funding_scheme'], 'string', 'max' => 7],
            [['call_year'], 'string', 'max' => 4],
            [['p_id'], 'unique'],
            [['p_rcn'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'p_id' => 'P ID',
            'p_rcn' => 'P Rcn',
            'acronym' => 'Acronym',
            'funding_scheme' => 'Funding Scheme',
            'call_year' => 'Call Year',
            'ppi_firstname' => 'Ppi Firstname',
            'ppi_lastname' => 'Ppi Lastname',
            'ppi_organization' => 'Ppi Organization',
            'organization_url' => 'Organization Url',
            'call_string' => 'Call String',
            'total_cost' => 'Total Cost',
            'erc_field' => 'Erc Field',
            'is_beneficiary' => 'Is Beneficiary',
        ];
    }
}
