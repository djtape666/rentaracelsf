<?php

namespace app\controllers;

use Yii;
use app\models\Application;
use app\models\AdminSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


/**
 * AdminController implements the CRUD actions for Application model.
 */
class AdminController extends Controller
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
public function actionUpdateCar($id)
{
    $model = \app\models\Car::findOne($id);

    if (!$model) {
        throw new \yii\web\NotFoundHttpException();
    }

    if ($model->load(Yii::$app->request->post()) && $model->save()) {

        $images = UploadedFile::getInstancesByName('images');

        foreach ($images as $file) {

            $fileName = '/images/' . uniqid() . '.' . $file->extension;
            $file->saveAs(Yii::getAlias('@webroot') . $fileName);

            $img = new \app\models\CarImage();
            $img->car_id = $model->id;
            $img->image_path = $fileName;
            $img->save();
        }

       Yii::$app->session->setFlash('success', 'Информация об автомобиле обновлена');

return $this->redirect(['/car/index']);
    }

    return $this->render('update', [
        'model' => $model,
    ]);
}
    /**
     * Lists all Application models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new AdminSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Application model.
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
     * Creates a new Application model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Application();

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
     * Updates an existing Application model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Application model.
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
     * Finds the Application model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return Application the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Application::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionAdmin()
    {
        $applications = \app\models\Application::find()
            ->with(['car.marka', 'status'])
            ->all();

        return $this->render('admin', [
            'applications' => $applications,
        ]);
    }

    public function actionChangeStatus($id, $alias)
    {
        $application = \app\models\Application::findOne($id);

        if (!$application) {
            throw new \yii\web\NotFoundHttpException();
        }

        $application->status_id = \app\models\Status::getIdByAlias($alias);
        $application->save(false);

        return $this->redirect(['admin/applications']);
    }

    public function actionApplications()
    {
        $applications = \app\models\Application::find()
            ->with(['car.marka', 'status'])
            ->all();

        return $this->render('applications', [
            'applications' => $applications,
        ]);
    }

    public function actionCreateCar()
    {
        $model = new \app\models\Car();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            $images = UploadedFile::getInstancesByName('images');

            foreach ($images as $file) {

                $fileName = '/images/' . uniqid() . '.' . $file->extension;
                $file->saveAs(Yii::getAlias('@webroot') . $fileName);

                $img = new \app\models\CarImage();
                $img->car_id = $model->id;
                $img->image_path = $fileName;
                $img->save();
            }

            return $this->redirect(['car/index']);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }
}




