<?php
use kartik\select2\Select2;
use kartik\depdrop\DepDrop;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\Countries;
$data=ArrayHelper::map(\common\models\Tags::find()->all(), 'tag_id', 'tag_name');

/* @var $this yii\web\View */
/* @var $model common\models\Students */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="students-form">

<?php $form = ActiveForm::begin([
    'options'=>['enctype'=>'multipart/form-data'] // important
]); ?>
    <div class="row">   
        <div class="col-md-6 col-sm-6">
<?= $form->field($model, 'student_id')->textInput() ?>
        </div>
        <div class="col-md-6 col-sm-6">
<?= $form->field($model, 'student_name')->textInput(['maxlength' => true]) ?>
        </div>
        
        <div class="col-md-6 col-sm-6">
<?= $form->field($model, 'address_1')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6 col-sm-6">
<?= $form->field($model, 'address_2')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 col-sm-12">
            <?= $form->field($model, 'country_id')->DropDownList(ArrayHelper::map(Countries::find()->all(), 'country_id', 'country_name')
            )
            ?>
        </div>
        <div class="col-md-6 col-sm-12">
            <?=
            $form->field($model, 'state_id')->widget(DepDrop::classname(), [
                'options' => ['state_id' => 'state_id'],
                'pluginOptions' => [
                    'depends' => ['students-country_id'],
                    'placeholder' => 'Select States',
                    'url' => Url::to(['student/get-states'])
                ]
            ]);
            ?>
        </div>
    </div>
    <div class="col-md-6 col-sm-6">
    <?= $form->field($model, 'gender')->radioList(['male' => 'Male', 'female' => 'Female']) ?> 
        </div>
    
    <div class="col-md-6 col-sm-6">
        
   <?= $form->field($model, 'interest')->widget(Select2::classname(), [
    'name' => 'interest',
    'data' => $data,
    'maintainOrder' => true,
    'options' => ['placeholder' => 'Select a interest ...', 'multiple' => true],
    'pluginOptions' => [
        'tags' => true,
        'maximumInputLength' => 20
    ],
]);?>
        </div>
    <div class="col-md-12 col-sm-6">
    <?=$form->field($model, 'image')->widget(FileInput::classname(), [
    'options'=>['accept'=>'image/*'],
    'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png']
]])?>
    </div>   
     <!--<?= $form->field($model, 'country_id')->textInput() ?>-->

     <!--<?= $form->field($model, 'state_id')->textInput() ?>-->
<div class="col-md-6 col-sm-6">
        <?= $form->field($model, 'updated_at')->textInput() ?>
  </div>
<div class="col-md-6 col-sm-6">     
        <?= $form->field($model, 'created_at')->textInput() ?>
  </div>
    <div class="form-group">
<?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>

</div>
