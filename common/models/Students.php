<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "students".
 *
 * @property integer $student_id
 * @property string $student_name
 * @property string $gender
 * @property string $address_1
 * @property string $address_2
 * @property integer $country_id
 * @property integer $state_id
 * @property string $updated_at
 * @property string $created_at
 *
 * @property StudentCourses[] $studentCourses
 * @property Countries $country
 * @property States $state
 */
class Students extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public $image;
    public static function tableName()
    {
        return 'students';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'gender'], 'required'],
            [['student_id', 'country_id', 'state_id'], 'integer'],
            [['gender'], 'string'],
//          [['interest'],'string','max'=>30],
            [['image'], 'safe'],
            [['image'], 'file', 'extensions'=>'jpg, gif, png'],
            [['updated_at', 'created_at'], 'safe'],
            [['student_name'], 'string', 'max' => 50],
            [['address_1', 'address_2'], 'string', 'max' => 255]
           
         //   [['country_id'],'exist','targetclass'=>'common\models\countries','target_attribute'=>'id']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'student_id' => 'Student ID',
            'student_name' => 'Student Name',
            'gender' => 'Gender',
            'interest'=>'Interest',
            'address_1' => 'Address 1',
            'address_2' => 'Address 2',
            'country_id' => 'Country Name',
            'state_id' => 'State Name',
            'image'=>'Upload',
            'updated_at' => 'Updated At',
            'created_at' => 'Created At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentCourses()
    {
        return $this->hasMany(StudentCourses::className(), ['student_id' => 'student_id']);
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
    public function getState()
    {
        return $this->hasOne(States::className(), ['state_id' => 'state_id']);
    }
    
    
}
