<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "fuel_type".
 *
 * @property int $id
 * @property string $title
 *
 * @property Car[] $cars
 */
class FuelType extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fuel_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * Gets query for [[Cars]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCars()
    {
        return $this->hasMany(Car::class, ['fuel_type_id' => 'id']);
    }
    public static function getPayType(): array
    {
        return static::find()
            ->select('title')
            ->indexBy('id')
            ->column();
    }
}
