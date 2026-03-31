<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Service;

/**
 * ServiceSearch represents the model behind the search form of `app\models\Service`.
 */
class ServiceSearch extends Service
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'department_id', 'sort_order'], 'integer'],
            [['name', 'slug', 'description', 'content', 'image_main', 'icon', 'animation', 'meta_keywords', 'meta_description', 'created_at', 'updated_at'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     * @param string|null $formName Form name to be used into `->load()` method.
     *
     * @return ActiveDataProvider
     */
   public function search($params)
{
    $query = Service::find();
    
    // Récupérer l'utilisateur connecté
    $user = \Yii::$app->user->identity;
    
    // Si l'utilisateur a un service_id (n'est pas admin), filtrer
    if ($user && $user->service_id !== null) {
        $query->andWhere(['id' => $user->service_id]);
    }

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);

    $this->load($params);

    if (!$this->validate()) {
        return $dataProvider;
    }

    // Filtres existants
    $query->andFilterWhere(['like', 'name', $this->name])
          ->andFilterWhere(['like', 'slug', $this->slug])
          ->andFilterWhere(['department_id' => $this->department_id]);

    return $dataProvider;
}
}
