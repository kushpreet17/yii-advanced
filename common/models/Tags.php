<?php

namespace common\models;

use Yii;
/**
 * This is the model class for table "tags".
 *
 * @property integer $tag_id
 * @property string $tag_name
 *
 * @property StudentTags[] $studentTags
 */
class Tags extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tags';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['tag_name'], 'required'],
            
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'tag_id' => 'Tag ID',
            'tag_name' => 'Tag Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStudentTags()
    {
        return $this->hasMany(StudentTags::className(), ['tag_id' => 'tag_id']);
    }


}