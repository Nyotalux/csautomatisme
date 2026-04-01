<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
    public static function tableName()
    {
        return 'user';
    }

    public function rules()
    {
        return [
            [['username', 'password'], 'required'],
            [['username', 'password', 'authKey', 'accessToken', 'first_name', 'last_name', 'phone', 'avatar'], 'string', 'max' => 255],
            [['service_id', 'sector_id', 'region_id', 'role_id', 'status'], 'integer'],
            [['created_at', 'updated_at', 'last_login'], 'safe'],
            [['username'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Nom d\'utilisateur',
            'password' => 'Mot de passe',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'first_name' => 'Prénom',
            'last_name' => 'Nom',
            'phone' => 'Téléphone',
            'avatar' => 'Avatar',
            'service_id' => 'Service',
            'sector_id' => 'Secteur',
            'region_id' => 'Région',
            'role_id' => 'Rôle',
            'status' => 'Statut',
            'created_at' => 'Créé le',
            'updated_at' => 'Modifié le',
            'last_login' => 'Dernière connexion',
        ];
    }

    // Relations
    public function getService()
    {
        return $this->hasOne(Service::class, ['id' => 'service_id']);
    }

    public function getSector()
    {
        return $this->hasOne(Sector::class, ['id' => 'sector_id']);
    }

    public function getRegion()
    {
        return $this->hasOne(Region::class, ['id' => 'region_id']);
    }

    public function getRole()
    {
        return $this->hasOne(Role::class, ['id' => 'role_id']);
    }

    // IdentityInterface
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['accessToken' => $token]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthKey()
    {
        return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
        return $this->authKey === $authKey;
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

    // Vérifier les permissions
    public function can($permission, $params = [])
    {
        if ($this->role && $this->role->permissions) {
            $permissions = json_decode($this->role->permissions, true);
            return isset($permissions[$permission]) && $permissions[$permission] === true;
        }
        return false;
    }

    // Vérifier si l'utilisateur a accès à un service
    public function hasServiceAccess($serviceId)
    {
        if ($this->role && $this->role->slug === 'admin') {
            return true;
        }
        return $this->service_id == $serviceId;
    }

    // Vérifier si l'utilisateur a accès à un secteur
    public function hasSectorAccess($sectorId)
    {
        if ($this->role && $this->role->slug === 'admin') {
            return true;
        }
        return $this->sector_id == $sectorId;
    }

    // Vérifier si l'utilisateur a accès à une région
    public function hasRegionAccess($regionId)
    {
        if ($this->role && $this->role->slug === 'admin') {
            return true;
        }
        return $this->region_id == $regionId;
    }

    public function getFullName()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }
}