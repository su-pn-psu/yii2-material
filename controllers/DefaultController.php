<?php

namespace suPnPsu\material\controllers;

use Yii;
use suPnPsu\material\models\Material;
use suPnPsu\material\models\MaterialSearch;

use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\data\ActiveDataProvider;
use suPnPsu\material\models\Repair;

use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * MaterialController implements the CRUD actions for Material model.
 */
class DefaultController extends Controller {

    public function behaviors() {
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
     * Lists all Material models.
     * @return mixed
     */
    public function actionIndex() {
       
        $searchModel = new MaterialSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
                    'searchModel' => $searchModel,
                    'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Material model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id) {
        return $this->render('view', [
                    'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Material model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate() {
        $model = new Material();

        /*if (Yii::$app->request->isPost) {

            $model->file = UploadedFile::getInstance($model, 'file');
            if(isset($model->file)){
                if ($model->upload()) {
                    $model->invt_image = basename($model->filepath);
                    Yii::$app->getSession()->setFlash('addfile', [
                        'type' => 'success',
                        'duration' => 4000,
                        'icon' => 'glyphicon glyphicon-ok-circle',
                        'message' => 'fileUploaded!',
                    ]);

                }else{
                    Yii::$app->getSession()->setFlash('addfile', [
                        'type' => 'danger',
                        'duration' => 4000,
                        'icon' => 'glyphicon glyphicon-ok-circle',
                        'message' => 'filenotUploaded!',
                    ]);
                }

            }

        }*/

        //$model->created_at = date('Y-md H:i');
        $model->created_at = 0;
        $model->created_by = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post())) {
            if($model->save()){
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                print_r($model->getErrors());
                //print_r($model->save());
            }

        } else {

            return $this->render('create', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Material model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id) {
        $model = $this->findModel($id);

        if (Yii::$app->request->isPost) {

            $model->file = UploadedFile::getInstance($model, 'file');
            if(isset($model->file)){
                if ($model->upload()) {
                    $model->invt_image = basename($model->filepath);
                    Yii::$app->getSession()->setFlash('addfile', [
                        'type' => 'success',
                        'duration' => 4000,
                        'icon' => 'glyphicon glyphicon-ok-circle',
                        'message' => 'fileUploaded!',
                    ]);

                }else{
                    Yii::$app->getSession()->setFlash('addfile', [
                        'type' => 'danger',
                        'duration' => 4000,
                        'icon' => 'glyphicon glyphicon-ok-circle',
                        'message' => 'filenotUploaded!',
                    ]);
                }

            }

        }
        $model->updated_at = date('Y-md H:i');
        $model->updated_by = Yii::$app->user->id;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                        'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Material model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id) {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Material model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Material the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id) {
        if (($model = Material::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function actionList($q) {
        //echo $q;
        $q = str_replace(['-_', '/_', '_'], '', $q);
        //echo $q;
        $data = Material::find()->where(['LIKE', 'id', $q])->all();
        $out = [];
        foreach ($data as $d) {
            $out[] = [
                'value' => $d['id'],
                'title' => $d['title'],
                'display' => $d['title'],
                'brand' => $d['brand'],
            ];
        }
        echo Json::encode($out);
    }

    public function actionHistory($id, $header = true) {
        $model = Material::find()->where(['LIKE', 'id', $id])->one();
        $dataProvider = new ActiveDataProvider([
            'query' => Repair::find()->where(['material_id' => $id, 'status' => [6,7]])->orderBy('id DESC'),
            'pagination' => [
                'pageSize' => 10,
            ],
        ]);
        //$this->view->title = 'Posts List';
        return $this->renderAjax('history', [
                    'listDataProvider' => $dataProvider,
                    'model' => $model,
                    'header' => $header
        ]);
    }

}
