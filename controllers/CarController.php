<?php

namespace app\controllers;

use app\models\Application;
use app\models\Status;
use yii\web\Controller;
use app\models\Car;
use Yii;

class CarController extends Controller
{
    public function actionIndex()
    {
        $cars = Car::find()->all();

        return $this->render('index', [
            'cars' => $cars,
        ]);
    }
public function actionView($id)
{


    $car = Car::findOne($id);

    if (!$car) {
        throw new \yii\web\NotFoundHttpException('Машина не найдена');
    }

    $application = new \app\models\Application();

    if ($application->load(Yii::$app->request->post())) {

    $application->car_id = $car->id;
    $application->user_id = Yii::$app->user->id;
    $application->created_at = date('Y-m-d H:i:s');
    $application->status_id = Status::getIdByAlias('new');

    //  1. Проверка дат (начало < конец)
    if ($application->start_date >= $application->end_date) {
        Yii::$app->session->setFlash('error', 'Дата окончания должна быть позже даты начала');
    } else {

        //  2. Проверка занятости
        $exists = \app\models\Application::find()
            ->where(['car_id' => $car->id])
            ->andWhere(['!=', 'status_id', Status::getIdByAlias('closed')])
            ->andWhere([
                'OR',
                [
                    'AND',
                    ['<=', 'start_date', $application->start_date],
                    ['>=', 'end_date', $application->start_date],
                ],
                [
                    'AND',
                    ['<=', 'start_date', $application->end_date],
                    ['>=', 'end_date', $application->end_date],
                ],
                [
                    'AND',
                    ['>=', 'start_date', $application->start_date],
                    ['<=', 'end_date', $application->end_date],
                ],
            ])
            ->exists();

        if ($exists) {
            Yii::$app->session->setFlash('error', 'Автомобиль уже занят на выбранные даты');
        } else {

            //  3. Сохранение
            if ($application->save()) {
                Yii::$app->session->setFlash('success', 'Заявка создана');
                return $this->refresh();
            }
        }
    }
    
}

    return $this->render('view', [
        'car' => $car,
        'application' => $application,
    ]);
}

}


