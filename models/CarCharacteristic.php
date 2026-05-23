<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car_characteristic".
 *
 * @property int $id
 * @property int $car_id
 * @property int $characteristic_id
 *
 * @property Car $car
 * @property Characteristic $characteristic
 */
class CarCharacteristic extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car_characteristic';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['car_id', 'characteristic_id'], 'required'],
            [['car_id', 'characteristic_id'], 'integer'],
            [['car_id'], 'exist', 'skipOnError' => true, 'targetClass' => Car::class, 'targetAttribute' => ['car_id' => 'id']],
            [['characteristic_id'], 'exist', 'skipOnError' => true, 'targetClass' => Characteristic::class, 'targetAttribute' => ['characteristic_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'car_id' => 'Car ID',
            'characteristic_id' => 'Characteristic ID',
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
     * Gets query for [[Characteristic]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCharacteristic()
    {
        return $this->hasOne(Characteristic::class, ['id' => 'characteristic_id']);
    }
public function getCharacteristicValue($categoryName)
{
    if ($this->characteristic && $this->characteristic->category && $this->characteristic->category->name == $categoryName) {
        return $this->characteristic->value;
    }
    return null;
}
}
