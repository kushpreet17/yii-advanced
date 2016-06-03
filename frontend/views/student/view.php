<?php
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\ActiveForm;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model common\models\Students */

$this->title = $model->student_id;
$this->params['breadcrumbs'][] = ['label' => 'Students', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
 $gridColumns = [
    ['class' => 'kartik\grid\SerialColumn'],
    'student_id',
    'syudent_name',
    'gender',
    'address 1',
    'address 2',    
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
   
?>


 
   <div class="students-view">
    <div class="course-index">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="pull-right">
                <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#educationBlock">
                   Add Education
                </button>
    </div></div>
            
    </div>
     <ul class="nav nav-tabs">
        <li class="active"><a href="#general" data-toggle="tab">General</a></li>
        <li><a href="#education" data-toggle="tab">Education</a></li>
     </ul>
    
    
     <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="general">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'student_id',
                    'student_name',
                    'gender',
                    'address_1',
                    'address_2',
                    'country_id'=>'country.country_name',
                    'state_id'=>'state.state_name',
                    'interest',
                    'image',
                    'updated_at',
                    'created_at',
                ],
            ]) ?>
        </div>
<!--    education  tab    -->
        <div role="tabpanel" class="tab-pane" id="education" >
<!--        <p>
        <?= Html::a('Update', ['update', 'id' => $model->student_id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->student_id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
                      </p>  -->
           
             
             <div id="education-list">
                 <?php echo $this->render('education',[
                        'courses' => $courses
                    ]);
                ?>
             </div>
             
              <!-- Modal -->
              <div class="modal fade" id="educationBlock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <?php $form = ActiveForm::begin([
                            'action' => ['save-education'],
                            'options' => ['id'=>'dynamic-education']
                        ]); ?>
                    <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Manage Education</h4>
                    </div>
                    <div class="modal-body">
                        
                    <div class="row">   
                         
                           <div class="col-md-12">

                                <?= $form->field($courseModel, 'student_id')->hiddenInput(['value'=> $model->student_id])->label(false);?>
                                <?= $form->field($courseModel, 'id')->hiddenInput(['value'=> ''])->label(false);?>
                            </div>
                            
                            <div class="col-md-12">
                               <?= $form->field($courseModel, 'course_name')->textInput() ?>
                            </div>
                            <div class="col-md-12">
                                <?= $form->field($courseModel, 'university')->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-md-12">
                                <?= $form->field($courseModel, 'year')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
                    </div>
                      <?php ActiveForm::end(); ?>
                  </div>
                </div>
              </div>
 
<!-- Delete Modal -->
      <div class="modal fade" id="courseDeleteBlock" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                      <?php $form = ActiveForm::begin([
                            'action' => ['delete-education'],
                            'options' => ['id'=>'deleted-education']
                        ]); ?>
                    <div class="modal-header">
                     <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                      <h4 class="modal-title" id="myModalLabel">Delete Education</h4>
                    </div>
                      
                    <div class="modal-body">
                     <div class="row">   
                      
                         <div class="col-md-12">
                                <?= $form->field($courseModel, 'student_id')->hiddenInput(['value'=> $model->student_id])->label(false);?>
                                <?= $form->field($courseModel, 'id')->hiddenInput(['value'=> ''])->label(false);?>
                            </div>
                           <p>Are you sure you want to delete this course details</p>
                        </div>
                    </div>
                      
                    <div class="modal-footer">
                      <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      <?= Html::submitButton('Delete', ['class' => 'btn btn-primary']) ?>
                    </div>
                      <?php ActiveForm::end(); ?>
                  </div>
                </div>
              </div>
        </div>
     </div>

<?php $this->registerJsFile('js/form.js', ['depends' => [yii\web\JqueryAsset::className()]]);?>

