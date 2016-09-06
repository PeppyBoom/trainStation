<?php

namespace app\controllers;

use app\models\TypeWagon;
use app\models\UploadImage;
use Yii;
use app\models\Wagon;
use app\models\search\WagonSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * WagonController implements the CRUD actions for Wagon model.
 */
class WagonController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Wagon models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new WagonSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Wagon model.
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
     * Creates a new Wagon model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Wagon();

        $type = TypeWagon::find()->where(['enabled' => 1, 'deleted' => 0])->all();
        $typeItems = ArrayHelper::map($type, 'id', 'type');

        $fileLoad = new UploadImage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $fileLoad->imageFile = UploadedFile::getInstance($fileLoad, 'imageFile');
            if ($fileLoad->upload()) {
                $model->img_path = 'uploads/' . $fileLoad->imageFile->baseName . '.' . $fileLoad->imageFile->extension;
                $model->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'typeItems' => $typeItems,
                'fileLoad' => $fileLoad,
            ]);
        }
    }

    /**
     * Updates an existing Wagon model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        $type = TypeWagon::find()->where(['enabled' => 1, 'deleted' => 0])->all();
        $typeItems = ArrayHelper::map($type, 'id', 'type');

        $fileLoad = new UploadImage();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $fileLoad->imageFile = UploadedFile::getInstance($fileLoad, 'imageFile');
            if ($fileLoad->upload()) {
                $model->img_path = 'uploads/' . $fileLoad->imageFile->baseName . '.' . $fileLoad->imageFile->extension;
                $model->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'typeItems' => $typeItems,
                'fileLoad' => $fileLoad,
            ]);
        }
    }

    /**
     * Deletes an existing Wagon model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->safeDelete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Wagon model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Wagon the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Wagon::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
