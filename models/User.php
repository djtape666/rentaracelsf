<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

use Yii;

/**
 * This is the model class for table "user".
 *
 * @property int $id
 * @property string $login
 * @property string $password
 * @property string $phone
 * @property int $age
 * @property string $email
 * @property int $role
 * @property string $auth_key
 *
 * @property Application[] $applications
 */
class User extends ActiveRecord implements IdentityInterface
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['role'], 'default', 'value' => 0],
            [['login', 'password', 'phone', 'age', 'email',], 'required'],
            [['age', 'role'], 'integer'],
            [['login', 'password', 'email', 'auth_key'], 'string', 'max' => 255],
            [['phone'], 'string', 'max' => 16],
            [['login'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'login' => 'Логин',
            'password' => 'Пароль',
            'phone' => 'Телефон',
            'age' => 'Возраст',
            'email' => 'Email',
            'role' => 'Role',
            'auth_key' => 'Auth Key',
        ];
    }

    /**
     * Gets query for [[Applications]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getApplications()
    {
        return $this->hasMany(Application::class, ['user_id' => 'id']);
    }



    public static function  findByUsername(string $login): bool|User
    {
        return static::findOne(['login' => $login]) ?? false;
    }

public function validatePassword(string $password): bool
{
return Yii::$app->security->validatePassword($password, $this->password);
}


    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return bool if auth key is valid for current user
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
public function getIsAdmin(): bool 
{
return $this->role == 1;
}
public function getIsClient(): bool 
{
return $this->role == 0;
}



}
