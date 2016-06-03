<?php
namespace common\models;
use Yii;
/**
 * This is the model class for table "courses".
 *
 * @property integer $id
 * @property string $course_name
 * @property string $university
 * @property integer $year
 */
class Courses extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'courses';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['course_name', 'university', 'year', 'student_id'], 'required'],
            [['year'], 'integer'],
            [['course_name', 'university'], 'string', 'max' => 30],
           ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'course_name' => 'Course Name',
            'university' => 'University',
            'year' => 'Year',
        ];
    }    
    
 public static function getCourses($studentId) {        
    return Courses::find()
            ->where(['student_id' => $studentId])
            ->all();
 }

 public static function getCourseById($courseId){
     return Courses::find()
            ->where(['id' => $courseId])
             ->asArray()
            ->one();
      }
 

    public static function deleteCourseById($courseId){
        return Courses::find()
                       ->where(['id'=>$courseId])
                       ->asArray()
                       ->one()
                       ->delete();
//               print_r($courses);
//               exit;
       
        
       
    }
 }
