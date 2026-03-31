<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Sector;

/**
 * SectorSearch represents the model behind the search form of `app\models\Sector`.
 */
class SectorSearch extends Sector
{
    /**
     * {@inheritdoc}
     */
  public function search($params)
{
    $query = Sector::find();
    
    $user = \Yii::$app->user->identity;
    
    // Si l'utilisateur a un service_id, filtrer les secteurs de ce service
    if ($user && $user->service_id !== null) {
        $query->andWhere(['service_id' => $user->service_id]);
    }

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);

    $this->load($params);

    if (!$this->validate()) {
        return $dataProvider;
    }

    $query->andFilterWhere(['like', 'name', $this->name])
          ->andFilterWhere(['like', 'slug', $this->slug])
          ->andFilterWhere(['service_id' => $this->service_id]);

    return $dataProvider;
}
}
