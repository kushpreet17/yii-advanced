<?php

namespace common\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "students".
 *
 * @property string $id
 * @property string $name
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property StudentEducation[] $studentEducations
 */
class Student extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'students';
    }
	
	public function behaviors()
{
    return [
        TimestampBehavior::className(),
    ];
}

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentEducations()
    {
        return $this->hasMany(StudentEducation::className(), ['student_id' => 'id']);
    }
}
