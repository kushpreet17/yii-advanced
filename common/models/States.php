<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "states".
 *
 * @property integer $state_id
 * @property string $state_name
 * @property integer $country_id
 *
 * @property Countries $country
 * @property Students[] $students
 */
class States extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'states';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['state_id'], 'required'],
            [['state_id', 'country_id'], 'integer'],
            [['state_name'], 'string', 'max' => 30]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'state_id' => 'State ID',
            'state_name' => 'State Name',
            'country_id' => 'Country ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCountry()
    {
        return $this->hasOne(Countries::className(), ['country_id' => 'country_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudents()
    {
        return $this->hasMany(Students::className(), ['state_id' => 'state_id']);
    }
    
    public static function getStatesByCountry($countryId) {
        return States::find()
                ->select(['id' => 'state_id', 'name' => 'state_name'])
                ->where(['country_id' => $countryId])
                ->orderBy('state_name asc')
                ->asArray()
                ->all();

    }
}
