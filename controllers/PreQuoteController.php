<?php

namespace app\controllers;

use Yii;
use app\models\PreQuote;
use app\models\PreQuoteSearch;
use app\models\PreQuoteClient;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\Response;

/**
 * PreQuoteController implements the CRUD actions for PreQuote model.
 */
class PreQuoteController extends Controller
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
     * Lists all PreQuote models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PreQuoteSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PreQuote model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PreQuote model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new PreQuote();
        Yii::$app->response->format = Response::FORMAT_JSON;
        if ($postData = Yii::$app->request->post()) {
            $postTraining = json_decode($postData['Training']);
            $postData = json_decode($postData['PreQuote']);
            $model->goLive = isset($postTraining->goLive) ? $postTraining->goLive : "";
            $model->staffTraining = isset($postTraining->staffTraining) ? $postTraining->staffTraining : "";
            $model->itTraining = isset($postTraining->itTraining) ? $postTraining->itTraining : "";
            $model->save();
            if ($model->save()) {
                foreach ($postData as $data) {
                    $model_client = new PreQuoteClient();
                    if (!empty($data->selectedItem)) {
                        $model_client->software = $data->selectedItem->software;
                        $model_client->clientType = $data->selectedItem->clientType;
                        $model_client->canadaPrice = $data->selectedItem->canadaPrice;
                        $model_client->usPrice = $data->selectedItem->usPrice;
                        $model_client->quantity = isset($data->quantity) ? $data->quantity : "";
                        $model_client->configuration = isset($data->configuration) ? $data->configuration : "";
                        $model_client->custom = isset($data->custom) ? $data->custom : "";
                        $model_client->labor = isset($data->labor) ? $data->labor : "";
                        $model_client->learning = isset($data->learning) ? $data->learning : "";
                        $model_client->locations = isset($data->locations) ? $data->locations : "";
                        $model_client->cost = isset($data->cost) ? $data->cost : "";
                        $model_client->notes = isset($data->notes) ? $data->notes : "";
                        $model_client->workflow = isset($data->workflow) ? $data->workflow : "";
                        $model_client->formula = isset($data->formula) ? $data->formula : "";
                        $model_client->qt_pre_quote_id = $model->id;
                        if (!($model_client->save())) {
                            return $model_client->errors;
                        }
                    }
                }
            } else {
                return $model->errors;
            }
            return "success";
        }
//        $model = new PreQuote();
//        $model_client= new PreQuoteClient();
//        if ($data = Yii::$app->request->post('client2')) {
//             //$data['client_2'];
//            return $data['id'];
//            $model->attributes = $data;
//            $model_client->attributes = $data;
//            return $model_client;
//
//            if ($model->save()) {
//                return("success");
//            } else {
//                return $model->errors;
//            }
//        } else {
////            return $this->render('create', [
////                'model' => $model,
////            ]);
//        }
    }


    /**
     * Updates an existing PreQuote model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public
    function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PreQuote model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public
    function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the PreQuote model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PreQuote the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected
    function findModel($id)
    {
        if (($model = PreQuote::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
