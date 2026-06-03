<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "feedback".
 *
 * @property int $application_id
 * @property string|null $comment
 * @property int $car_rating
 * @property int $booking_rating
 * @property int $service_rating
 * @property int $expectation_rating
 *
 * @property Application $application
 */
class Feedback extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'feedback';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['comment'], 'default', 'value' => null],
            [['comment'], 'string'],
            [['car_rating', 'booking_rating', 'service_rating', 'expectation_rating'], 'required'],
            [['car_rating', 'booking_rating', 'service_rating', 'expectation_rating'], 'integer'],
            [['application_id'], 'exist', 'skipOnError' => true, 'targetClass' => Application::class, 'targetAttribute' => ['application_id' => 'id']],

            [
    ['car_rating', 'booking_rating', 'service_rating', 'expectation_rating'],
    'integer',
    'min' => 1,
    'max' => 5
],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'application_id' => 'ID заявки',
           'car_rating' => 'Состояние автомобиля',
        'booking_rating' => 'Удобство бронирования',
        'service_rating' => 'Качество обслуживания',
        'expectation_rating' => 'Соответствие ожиданиям',
        'comment' => 'Ваш отзыв',
        ];
    }

    /**
     * Gets query for [[Application]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplication()
    {
        return $this->hasOne(Application::class, ['id' => 'application_id']);
    }

}
