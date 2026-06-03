<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chat_message".
 *
 * @property int $id
 * @property int $application_id
 * @property int $user_id
 * @property string $message
 * @property string $created_at
 * @property int $is_read
 *
 * @property Application $application
 * @property User $user
 */
class ChatMessage extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'chat_message';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['is_read'], 'default', 'value' => 0],
            [['application_id', 'user_id', 'message', 'created_at'], 'required'],
            [['application_id', 'user_id', 'is_read'], 'integer'],
            [['message'], 'string'],
            [['created_at'], 'safe'],
            [['application_id'], 'exist', 'skipOnError' => true, 'targetClass' => Application::class, 'targetAttribute' => ['application_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'application_id' => 'Application ID',
            'user_id' => 'User ID',
            'message' => 'Message',
            'created_at' => 'Created At',
            'is_read' => 'Is Read',
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

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

}
