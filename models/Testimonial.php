<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class Testimonial extends ActiveRecord
{
    public static function tableName()
    {
        return 'testimonial';
    }

    public function rules()
    {
        return [
            [['client_name', 'content'], 'required'],
            [['client_name', 'client_company', 'client_image'], 'string', 'max' => 255],
            [['content'], 'string'],
            [['rating', 'status', 'sort_order'], 'integer'],
            [['created_at', 'updated_at'], 'safe'],
            [['rating'], 'in', 'range' => [1, 2, 3, 4, 5]],
            [['status'], 'in', 'range' => [0, 1]],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_name' => 'Nom du client',
            'client_company' => 'Entreprise',
            'client_image' => 'Photo',
            'content' => 'Témoignage',
            'rating' => 'Note',
            'status' => 'Statut',
            'sort_order' => 'Ordre',
            'created_at' => 'Créé le',
            'updated_at' => 'Modifié le',
        ];
    }
    
    // Optionnel : ajouter une méthode pour obtenir les étoiles
    public function getStars()
    {
        $stars = '';
        for ($i = 1; $i <= 5; $i++) {
            if ($i <= $this->rating) {
                $stars .= '<i class="fas fa-star text-warning"></i>';
            } else {
                $stars .= '<i class="fas fa-star text-muted"></i>';
            }
        }
        return $stars;
    }
}