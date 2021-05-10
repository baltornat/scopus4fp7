<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publications.affiliation".
 *
 * @property string $afid
 * @property string|null $afname
 * @property string|null $afcity
 * @property string|null $afcountry
 */
class PublicationsAffiliation extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'publications.affiliation';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['afid'], 'required'],
            [['afid', 'afname', 'afcity', 'afcountry'], 'string'],
            [['afid'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'afid' => 'Afid',
            'afname' => 'Afname',
            'afcity' => 'Afcity',
            'afcountry' => 'Afcountry',
        ];
    }
}
