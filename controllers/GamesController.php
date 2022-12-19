<?php

namespace app\controllers;

use app\models\Game;
use app\search\GameSearch;
use Yii;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * GamesController implements the CRUD actions for Game model.
 */
class GamesController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Game models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new GameSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Game model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Game model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Game();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Game model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            $image = UploadedFile::getInstances($model, 'poster_image_file')[0];
            if($image) {
                if($model->poster_image) {
                    FileHelper::unlink($model->poster_image);
                }
                if($image->saveAs('img/posters/' . $model->id . '_'. $image->baseName . '.' . $image->extension)) {
                    $model->poster_image =  Url::base(true) . '/img/posters/' . $model->id . '_'. $image->baseName . '.' . $image->extension;
                    $model->save();
                }
            }
            $image = UploadedFile::getInstances($model, 'small_icon_file')[0];
            if($image) {
                if($model->small_icon_image) {
                    FileHelper::unlink($model->small_icon_image);
                }
                if($image->saveAs('img/icons/' . $model->id . '_'. $image->baseName . '.' . $image->extension)) {
                    $model->small_icon_image =  Url::base(true) . '/img/icons/' . $model->id . '_'. $image->baseName . '.' . $image->extension;
                    $model->save();
                }
            }
            $image = UploadedFile::getInstances($model, 'gameplay_image_file')[0];
            if($image) {
                if(file_exists($model->gameplay_image)) {
                    FileHelper::unlink($model->gameplay_image);
                }
                if($image->saveAs('img/gameplay_images/' . $model->id . '_'. $image->baseName . '.' . $image->extension)) {
                    $model->gameplay_image = Url::base(true) . '/img/gameplay_images/' . $model->id . '_'. $image->baseName . '.' . $image->extension;
                    $model->save();
                }
            }
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Game model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Game model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Game the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Game::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
