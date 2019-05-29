<?php

namespace vendor\groovy\src\email\controllers;

use Yii;
use vendor\groovy\src\email\models\EmailTemplate;
use vendor\groovy\src\email\models\EmailTemplateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\filters\AccessControl;
use yii\helpers\Url;



/**
 * DefaultController implements the CRUD actions for EmailTemplate model.
 */
class DefaultController extends Controller
{

    public $configComponentName = 'emailtemplate';
    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),              
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => [],
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['create','index', 'update', 'view', 'delete', 'uploadimage','getcontent'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all EmailTemplate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmailTemplateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $configure = Yii::$app->get($this->configComponentName, true);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'configure'=>$configure,
        ]);
    }

    /**
     * Displays a single EmailTemplate model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new EmailTemplate model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new EmailTemplate();
        $configure = Yii::$app->get($this->configComponentName, true);
        if(!$configure->allowInsert){
            return $this->redirect(['index']);
        }
        if ($model->load(Yii::$app->request->post())) {
            $model->email_slug = $this->create_slug(strtolower($model->emai_template_name));
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    function create_slug($string){
        $slug=preg_replace('/[^A-Za-z0-9-]+/', '_', $string);
        return $slug;
     }

    /**
     * Updates an existing EmailTemplate model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing EmailTemplate model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $configure = Yii::$app->get($this->configComponentName, true);
        if(!$configure->allowDelete){
            return $this->redirect(['index']);
        }
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the EmailTemplate model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return EmailTemplate the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EmailTemplate::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionUploadimage(){       
        $file = UploadedFile::getInstanceByName('file');
        $uploadPath = \Yii::$app->basePath .'/../uploads/extrnal/';
        if(!is_dir($uploadPath)){
            mkdir($uploadPath);   
        }
        $allowed =  array('gif','png' ,'jpg','jpeg');
        $filename = $file->baseName;
       
        $ext = pathinfo($file->name, PATHINFO_EXTENSION);
        if(!in_array($ext,$allowed) ) {
            Yii::$app->api->sendFailedResponse('Image Not Valid.');
        }
        $original_name = $file->baseName;  
        $newFileName = $original_name.'_'.time().'.'.$file->extension;
        if ($file->saveAs($uploadPath . '/' . $newFileName)) {
            $file_location = 'uploads/extrnal/'. $newFileName;   
            return json_encode(array("location"=>Url::base(true).'/'.$file_location));die;;
        }
        
        print_r($file);die;
    }

    public function actionGetcontent(){
        $configure = Yii::$app->get('emailtemplate', true);
        if(!empty($configure->dummycontent)){
            $content = file_get_contents($configure->dummycontent);
            echo json_encode(['status'=>true,"html"=>$content]);die;
        }else{
            $content = "Dummy Content File Not Set....";
            echo json_encode(['status'=>true,"html"=>$content]);die;
        }
    }
}
