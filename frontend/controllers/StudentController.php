<?php
namespace frontend\controllers;
use Yii;
use common\models\Students;
use common\models\StudentSearch;
use common\models\States;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
//use kartik\mpdf\Pdf;
use yii\db\Query;
/**
 * StudentController implements the CRUD actions for Students model.
 */
class StudentController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ];
    }
   
    /**
     * Lists all Students models.
     * @return mixed
     */
//    public function actionIndex()
//    {
//        $searchModel = new StudentSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
//
//         return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }
    
    public function actionIndex()
    {

          $params=$_REQUEST;
          $filter=array();
          $sort="";

          $page=1;
          $limit=5;

           if(isset($params['page']))
             $page=$params['page'];


           if(isset($params['limit']))
              $limit=$params['limit'];

            $offset=$limit*($page-1);

            if(isset($params['sort']))
            {
              $sort=$params['sort'];
         if(isset($params['order']))
        {  
            if($params['order']=="false")
             $sort.=" desc";
            else
             $sort.=" asc";

        }
            }
               $query=new Query;
               $query->offset($offset)
                 ->limit($limit)
                 ->from('students')
                 ->orderBy($sort)      
                 ->select("student_id,student_name,gender,interest,address_1,address_2,country_id,state_id,uploads,updated_at,created_at");

          
           $command = $query->createCommand();
               $models = $command->queryAll();

               $totalItems=$query->count();

          $this->setHeader(200);

          echo json_encode(array('status'=>1,'data'=>$models,'totalItems'=>$totalItems),JSON_PRETTY_PRINT);

    }

/* Functions to set header with status code. eg: 200 OK ,400 Bad Request etc..*/        
private function setHeader($status)
{

    $status_header = 'HTTP/1.1 ' . $status . ' ' . $this->_getStatusCodeMessage($status);
    $content_type="application/json; charset=utf-8";

    header($status_header);
    header('Content-type: ' . $content_type);
    header('X-Powered-By: ' . "Nintriva <nintriva.com>");
}
private function _getStatusCodeMessage($status)
{
    $codes = Array(
    200 => 'OK',
    400 => 'Bad Request',
    401 => 'Unauthorized',
    402 => 'Payment Required',
    403 => 'Forbidden',
    404 => 'Not Found',
    500 => 'Internal Server Error',
    501 => 'Not Implemented',
    );
    return (isset($codes[$status])) ? $codes[$status] : '';
}      

    /**
     * Displays a single Students model.
     * @param integer $id
     * @return mixed
     */
//    public function actionView($id)
//    {
//        $courseModel = new \common\models\Courses();
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//            'courseModel' => $courseModel,
//            'courses' => \common\models\Courses::getCourses($id),
//              
//        ]);
//    }
public function actionView($id)
{

  $model=$this->findModel($id);

  $this->setHeader(200);
  echo json_encode(array('status'=>1,'data'=>array_filter($model->attributes)),JSON_PRETTY_PRINT);

} 
  /* function to find the requested record/model */
protected function findModel($id)
{
    if (($model = Students::findOne($id)) !== null) {
    return $model;
    } else {

      $this->setHeader(400);
      echo json_encode(array('status'=>0,'error_code'=>400,'message'=>'Bad request'),JSON_PRETTY_PRINT);
      exit;
    }
}
    /**
     * Creates a new Students model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Students();
        Yii::$app->params['uploadPath'] = Yii::$app->basePath . '/uploads/';
//        return Yii::$app->params['uploadPath'];
//        exit;
        if ($model->load(Yii::$app->request->post())) {
           // get the uploaded file instance. for multiple file uploads
            // the following data will return an array
            $image = UploadedFile::getInstance($model, 'image');

            // store the source file name
            $model->image = $image->name;
            $ext = end((explode(".", $image->name)));

            // generate a unique file name
            $model->uploads = Yii::$app->security->generateRandomString().".{$ext}";
            
            // the path to save file, you can set an uploadPath
            // in Yii::$app->params (as used in example below)
            $path = Yii::$app->params['uploadPath'] . $model->uploads;

            if($model->save()){
                $image->saveAs($path);
                return $this->redirect(['view', 'id'=>$model->student_id]);
            } else {
                // error in saving model
            }
            
//            return $this->redirect(['view', 'id' => $model->student_id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                         ]);
        }
    }

    /**
     * Updates an existing Students model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->student_id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Deletes an existing Students model.
     * If deletion is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }
    /**
     * Finds the Students model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Students the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
//    protected function findModel($id)
//    {
//        if (($model = Students::findOne($id)) !== null) {
//            return $model;
//        } else {
//            throw new NotFoundHttpException('Requested student not found.');
//        }
//    }
    
    public function actionGetStates() {
        $out = [];
       if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $countryId = $parents[0];
                $out = States::getStatesByCountry($countryId); 
                // the getSubCatList function will query the database based on the
                // cat_id and return an array like below:
                // [
                //    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
                //    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
                // ]
                
                echo \yii\helpers\Json::encode(['output'=>$out, 'selected'=>'']);
                return;
            }
        }
        echo Json::encode(['output'=>'', 'selected'=>'']);
    }
    
    public function actionSaveEducation()
    {
       $courseModel = new \common\models\Courses();
       $postData = \Yii::$app->getRequest()->post();
//       print_r($postData);
//       exit;
        if($postData['Courses']['id']) {
            $courseModel =  \common\models\Courses::findOne($postData['Courses']['id']);
            $courseModel->course_name = $postData['Courses']['course_name'];
            $courseModel->university = $postData['Courses']['university'];
            $courseModel->year = $postData['Courses']['year'];
            $courseModel->update();
           $coursesModels = \common\models\Courses::getCourses($courseModel->student_id);
             
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => 'ok', 'html' => $this->renderPartial('education', [
                'courses' => $coursesModels
            ])];
        }
        else if ($courseModel->load($postData)) {
            
            $courseModel->save();
            $coursesModels = \common\models\Courses::getCourses($courseModel->student_id);
             
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => 'ok', 'html' => $this->renderPartial('education', [
                'courses' => $coursesModels
            ])];
        }
       
    }
    
    public function actionGetStudentCourse($courseId) {
     
        $courseModel = \common\models\Courses::getCourseById($courseId);
       
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON; 
       return $courseModel;
    }
   
    
     
     public function actionDeleteEducation($courseId)
    {
//       $courseModel = new \common\models\Courses();
       $courseModel =  \common\models\Courses::deleteCourseById($courseId);
      
       $coursesModels = \common\models\Courses::getCourses($courseModel->student_id);
      \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return ['success' => 'ok', 'html' => $this->renderPartial('education', [
                'courses' => $coursesModels
            ])];
    }
    
    
   
}
