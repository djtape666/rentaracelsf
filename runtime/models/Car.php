<?php

namespace app\models;

use Yii;
use app\models\CarImage;
/**
 * This is the model class for table "car".
 *
 * @property int $id
 * @property string $color
 * @property int $transmission_type_id
 * @property int $fuel_type_id
 * @property int $marka_id
 * @property int $price
 * @property int $engine_power
 * @property string $description
 * @property string $model
 * @property int|null $year
 * @property int|null $is_available
 *
 * @property Application[] $applications
 * @property CarImage[] $carImages
 * @property FuelType $fuelType
 * @property Marka $marka
 * @property TransmissionType $transmissionType
 */
class Car extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['year'], 'default', 'value' => null],
            [['is_available'], 'default', 'value' => 1],
            [['color', 'transmission_type_id', 'fuel_type_id', 'marka_id', 'price', 'engine_power', 'description', 'model'], 'required'],
            [['transmission_type_id', 'fuel_type_id', 'marka_id', 'price', 'engine_power', 'year', 'is_available'], 'integer'],
            [['description'], 'string'],
            [['color', 'model'], 'string', 'max' => 255],
            [['fuel_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => FuelType::class, 'targetAttribute' => ['fuel_type_id' => 'id']],
            [['marka_id'], 'exist', 'skipOnError' => true, 'targetClass' => Marka::class, 'targetAttribute' => ['marka_id' => 'id']],
            [['transmission_type_id'], 'exist', 'skipOnError' => true, 'targetClass' => TransmissionType::class, 'targetAttribute' => ['transmission_type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'color' => 'Цвет',
            'transmission_type_id' => 'Коробка переключения передач',
            'fuel_type_id' => 'Вид топлива',
            'marka_id' => 'Марка',
            'price' => 'Цена за сутки',
            'engine_power' => 'Мощность',
            'description' => 'Описание',
            'model' => 'Модель',
            'year' => 'Год выпуска',
            'is_available' => 'Is Available',
        ];
    }

    /**
     * Gets query for [[Applications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::class, ['car_id' => 'id']);
    }

    /**
     * Gets query for [[CarImages]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarImages()
    {
        return $this->hasMany(CarImage::class, ['car_id' => 'id']);
    }
    public function getMainImage()
{
    return $this->carImages[0] ?? null;
}

    /**
     * Gets query for [[FuelType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFuelType()
    {
        return $this->hasOne(FuelType::class, ['id' => 'fuel_type_id']);
    }

    /**
     * Gets query for [[Marka]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMarka()
    {
        return $this->hasOne(Marka::class, ['id' => 'marka_id']);
    }

    /**
     * Gets query for [[TransmissionType]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTransmissionType()
    {
        return $this->hasOne(TransmissionType::class, ['id' => 'transmission_type_id']);
    }
public function getImages()
{
    return $this->hasMany(CarImage::class, ['car_id' => 'id']);
}
public function getFullName()
{
    return $this->marka->title . ' ' . $this->model;
}
}
