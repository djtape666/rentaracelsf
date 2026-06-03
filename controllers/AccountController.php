<?php

namespace app\controllers;

use app\models\Application;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use app\models\ChatMessage;
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


    public function actionFeedback($id)
{
    $application = \app\models\Application::findOne($id);

    if (!$application) {
        throw new \yii\web\NotFoundHttpException();
    }

    // Только владелец заявки может оставить отзыв
    if ($application->user_id != Yii::$app->user->id) {
        throw new \yii\web\ForbiddenHttpException();
    }

    // Отзыв уже существует
    if ($application->feedback) {

        Yii::$app->session->setFlash(
            'error',
            'Отзыв уже был оставлен.'
        );

        return $this->redirect(['/account/applications']);
    }

    $model = new \app\models\Feedback();
    $model->application_id = $application->id;

    if (
        $model->load(Yii::$app->request->post())
        && $model->save()
    ) {

        Yii::$app->session->setFlash(
            'success',
            'Спасибо за ваш отзыв!'
        );

        return $this->redirect(['/account/index']);
    }

    return $this->render('feedback', [
        'model' => $model,
        'application' => $application,
    ]);
}
public function actionChat($id)
{
    $application = Application::findOne($id);

    if (!$application) {
        throw new \yii\web\NotFoundHttpException();
    }

    // Пользователь может открыть только свои заявки
    if ($application->user_id != Yii::$app->user->id) {
        throw new \yii\web\ForbiddenHttpException();
    }

    $message = new ChatMessage();

    if ($message->load(Yii::$app->request->post())) {

        $message->application_id = $application->id;
        $message->user_id = Yii::$app->user->id;
        $message->created_at = date('Y-m-d H:i:s');
        $message->is_read = 0;

        $message->save();

        return $this->refresh();
    }

    $messages = ChatMessage::find()
        ->where(['application_id' => $application->id])
        ->orderBy(['created_at' => SORT_ASC])
        ->all();

    return $this->render('chat', [
        'application' => $application,
        'message' => $message,
        'messages' => $messages,
    ]);
}
}