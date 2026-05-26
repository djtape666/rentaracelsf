<?php

namespace app\controllers;

use app\models\Application;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use Yii;

/**
 * AccountController implements the CRUD actions for Application model.
 */
class AccountController extends Controller
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
     * Lists all Application models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $applications = \app\models\Application::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->all();

        return $this->render('index', [
            'applications' => $applications,
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
        $application = \app\models\Application::findOne($id);

        if (!$application) {
            throw new \yii\web\NotFoundHttpException('Заявка не найдена');
        }

        // проверка владельца
        if ($application->user_id != Yii::$app->user->id) {
            throw new \yii\web\ForbiddenHttpException('У вас нет доступа');
        }

        return $this->render('view', [
            'application' => $application,
        ]);
    }

    /**
     * Creates a new Application model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {

// Проверяем, авторизован ли пользователь
    if (Yii::$app->user->isGuest) {
        Yii::$app->session->setFlash('error', 'Для бронирования автомобиля необходимо авторизоваться или зарегистрироваться.');
        return $this->redirect(['/site/login']);
    }


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


    public function actionSetRating($id, $rating)
{


    $application = \app\models\Application::findOne($id);

    if (!$application) {
        throw new \yii\web\NotFoundHttpException();
    }

    // защита
    if ($application->user_id != Yii::$app->user->id) {
        throw new \yii\web\ForbiddenHttpException();
    }

    // только закрытые
    if ($application->status->alias != 'closed') {
        return $this->redirect(['account/index']);
    }

    // уже есть отзыв?
    if ($application->feedback) {
        return $this->redirect(['account/index']);
    }

    $feedback = new \app\models\Feedback();
    $feedback->application_id = $application->id;
    $feedback->rating = $rating;

    if ($feedback->save()) {
        Yii::$app->session->setFlash('success', 'Спасибо за оценку!');
    }

    return $this->redirect(['account/index']);
}
}