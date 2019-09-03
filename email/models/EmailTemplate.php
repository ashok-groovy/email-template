<?php

namespace vendor\groovy\src\email\models;

use Yii;

/**
 * This is the model class for table "email_template".
 *
 * @property int $id
 * @property string $emai_template_name
 * @property string $email_status
 * @property string $email_slug
 */
class EmailTemplate extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'email_template';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['emai_template_name', 'email_status','email_subject'], 'required'],
            [['email_status','email_content','email_available_tags'], 'string'],
            [['text_version'], 'safe'],
            [['emai_template_name', 'email_slug'], 'string', 'max' => 100],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'emai_template_name' => Yii::t('app', 'Emai Template Name'),
            'email_status' => Yii::t('app', 'Email Status'),
            'email_slug' => Yii::t('app', 'Email Slug'),
            'email_available_tags' => Yii::t('app', 'Email Available Tags'),
        ];
    }
}
