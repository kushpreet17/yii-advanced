<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "student_courses".
 *
 * @property integer $course_id
 * @property integer $student_id
 * @property string $course
 * @property integer $passing_year
 * @property string $university
 * @property string $created_at
 * @property string $updated_at
 *
 * @property Students $student
 */
class StudentCourses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'student_courses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_id'], 'required'],
            [['course_id', 'student_id', 'passing_year'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['course', 'university'], 'string', 'max' => 30],
            [['student_id'], 'exist', 'skipOnError' => true, 'targetClass' => Students::className(), 'targetAttribute' => ['student_id' => 'student_id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'course_id' => 'Course ID',
            'student_id' => 'Student ID',
            'course' => 'Course',
            'passing_year' => 'Passing Year',
            'university' => 'University',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudent()
    {
        return $this->hasOne(Students::className(), ['student_id' => 'student_id']);
    }
}
