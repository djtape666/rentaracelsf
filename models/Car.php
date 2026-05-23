<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "car".
 *
 * @property int $id
 * @property string $color
 * @property int $price
 * @property int $engine_power
 * @property string $description
 * @property string $model
 * @property int|null $year
 * @property int|null $is_available
 *
 * @property Application[] $applications
 * @property CarCharacteristic[] $carCharacteristics
 * @property CarImage[] $carImages
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
            [['color', 'price', 'engine_power', 'description', 'model'], 'required'],
            [['price', 'engine_power', 'year', 'is_available'], 'integer'],
            [['description'], 'string'],
            [['color', 'model'], 'string', 'max' => 255],
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
            'price' => 'Цена за сутки',
            'engine_power' => 'Мощность(л/с)',
            'description' => 'Описание',
            'model' => 'Модель',
            'year' => 'Год',
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
     * Gets query for [[CarCharacteristics]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCarCharacteristics()
    {
        return $this->hasMany(CarCharacteristic::class, ['car_id' => 'id']);
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

public function getImages()
{
    return $this->hasMany(CarImage::class, ['car_id' => 'id']);
}

public function getCharacteristic($categoryName)
    {
        // Находим категорию по названию
        $category = Category::find()->where(['name' => $categoryName])->one();
        
        if (!$category) {
            return null;
        }
        
        // Находим характеристику автомобиля для этой категории
        $carCharacteristic = CarCharacteristic::find()
            ->joinWith('characteristic')
            ->where([
                'car_characteristic.car_id' => $this->id,
                'characteristic.category_id' => $category->id
            ])
            ->one();
        
        if ($carCharacteristic && $carCharacteristic->characteristic) {
            return $carCharacteristic->characteristic->value;
        }
        
        return null;
    }
    
   public function getCharacteristicsArray()
{
    $result = [];
    foreach ($this->carCharacteristics as $carCharacteristic) {
        if ($carCharacteristic->characteristic && $carCharacteristic->characteristic->category) {
            $categoryName = $carCharacteristic->characteristic->category->name;
            $result[$categoryName] = $carCharacteristic->characteristic->value;
        }
    }
    return $result;
}
public function getCharacteristicValue($categoryName)
{
    $characteristics = $this->getCharacteristicsArray();
    return $characteristics[$categoryName] ?? null;
}
}



