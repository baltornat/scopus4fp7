<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "authors.institution".
 *
 * @property string $institution_name
 * @property string|null $institution_tokens
 * @property string|null $md_institution_tokens
 */
class AuthorsInstitution extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'authors.institution';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['institution_name'], 'required'],
            [['institution_name', 'institution_tokens', 'md_institution_tokens'], 'string'],
            [['institution_name'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'institution_name' => 'Institution Name',
            'institution_tokens' => 'Institution Tokens',
            'md_institution_tokens' => 'Md Institution Tokens',
        ];
    }
}
