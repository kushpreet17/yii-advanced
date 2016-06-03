<?php

use yii\helpers\Html;
//use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Countries;
use common\models\States;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\models\StudentSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Students';
$this->params['breadcrumbs'][] = $this->title;
 
?>
<div class="students-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        
        <?= Html::a('Add Students', ['create'], ['class' => 'btn btn-success']) ?>
        <?= Html::a('Download Pdf',['pdf'],['class'=>'btn btn-primary'])?>
        <?php $gridColumns = [
    'student_id',
    'student_name',
    'gender',
    'address_1',
    'address_2',    
    [
        'attribute'=>'country_id',
        'label'=>'Country Name',
        'vAlign'=>'middle',
        'width'=>'190px',
        'value'=>'country.country_name',
        'format'=>'raw'
    ],
          [
        'attribute'=>'state_id',
        'label'=>'State Name',
        'vAlign'=>'middle',
        'width'=>'190px',
        'value'=>'state.state_name',
        'format'=>'raw'   
          ]
   
];
echo ExportMenu::widget([
    'dataProvider' => $dataProvider,
    'columns' => $gridColumns,
    
]);?>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'student_id',
            'student_name',
           // 'gender',
//            'address_1',
//            'address_2',
  [
    'attribute' => 'country_id',
    'value' => 'country.country_name',
    'filter' => Html::activeDropDownList($searchModel, 'country_id', ArrayHelper::map(Countries::find()->asArray()->all(),'country_id', 'country_name'),['class'=>'form-control','prompt' => 'Select Country']),
 
      ],
            [
    'attribute' => 'state_id',
    'value' => 'state.state_name',
    'filter' => Html::activeDropDownList($searchModel, 'state_id', ArrayHelper::map(States::find()->orderBy('state_name','ASC')->asArray()->all(),'state_id', 'state_name'),['class'=>'form-control','prompt' => 'Select State']),

            ],
             //'country_id',
             //'state_id',
             //'updated_at',
            // 'created_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); 
    ?>

</div>
