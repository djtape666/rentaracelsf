<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "application".
 *
 * @property int $id
 * @property string $created_at
 * @property int $car_id
 * @property int $pay_type_id
 * @property string $phone
 * @property string $end_date
 * @property string $start_date
 * @property int $status_id
 * @property int $user_id
 *
 * @property Car $car
 * @property Feedback $feedback
 * @property PayType $payType
 * @property Status $status
 * @property User $user
 */
class Application extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'application';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['created_at', 'car_id', 'pay_type_id', 'phone', 'end_date', 'start_date', 'status_id', 'user_id'], 'required'],
            [['created_at', 'end_date', 'start_date'], 'safe'],
            [['car_id', 'pay_type_id', 'status_id', 'user_id'], 'integer'],
            [['phone'], 'string', 'max' => 16],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Car::class, 'targetAttribute' => ['car_id' => 'id']],
            [['pay_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => PayType::class, 'targetAttribute' => ['pay_type_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => Status::class, 'targetAttribute' => ['status_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],

             ['start_date', 'validateStartDate'],

        ['end_date', 'compare',
            'compareAttribute' => 'start_date',
            'operator' => '>',
            'message' => 'Дата окончания должна быть больше даты начала'
        ],
            [
    ['start_date'],
    'compare',
    'compareValue' => date('Y-m-d'),
    'operator' => '>=',
    'message' => 'Дата начала аренды не может быть меньше текущей даты'
],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'created_at' => 'Created At',
            'car_id' => 'Car ID',
            'pay_type_id' => 'Тип оплаты',
            'phone' => 'Телефон',
            'end_date' => 'Дата окончания аренды',
            'start_date' => 'Дата начала аренды',
            'status_id' => 'Статус',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Car]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCar()
    {
        return $this->hasOne(Car::class, ['id' => 'car_id']);
    }

    /**
     * Gets query for [[Feedback]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFeedback()
    {
        return $this->hasOne(Feedback::class, ['application_id' => 'id']);
    }

    /**
     * Gets query for [[PayType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPayType()
    {
        return $this->hasOne(PayType::class, ['id' => 'pay_type_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatus()
    {
        return $this->hasOne(Status::class, ['id' => 'status_id']);
    }
public function getChatMessages()
    {
        return $this->hasMany(ChatMessage::class, ['application_id' => 'id']);
    }
    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
public function validateStartDate($attribute)
{
    if (strtotime($this->$attribute) < time()) {

        $this->addError(
            $attribute,
            'Дата и время начала аренды не могут быть меньше текущих'
        );
    }
}
}
