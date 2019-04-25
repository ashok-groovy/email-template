<?php

namespace vendor\groovy\src\email\controllers;

use Yii;
use vendor\groovy\src\email\models\EmailTemplate;
use vendor\groovy\src\email\models\EmailTemplateSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\Url;



/**
 * DefaultController implements the CRUD actions for EmailTemplate model.
 */
class DefaultController extends Controller
{

    public function beforeAction($action) 
    { 
        $this->enableCsrfValidation = false; 
        return parent::beforeAction($action); 
    }

    /**
     * Lists all EmailTemplate models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new EmailTemplateSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
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

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
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
}