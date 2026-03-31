<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Gallery;

/**
 * GallerySearch represents the model behind the search form of `app\models\Gallery`.
 */
class GallerySearch extends Gallery
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'entity_id', 'sort_order'], 'integer'],
            [['entity_type', 'image', 'caption', 'created_at', 'updated_at'], 'safe'],
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
    $query = Gallery::find();
    
    $user = \Yii::$app->user->identity;
    
    // Filtrer selon le service de l'utilisateur
    if ($user && $user->service_id !== null) {
        // Les galleries sont liées à des services ou secteurs
        $query->andWhere([
            'OR',
            ['AND', ['entity_type' => 'service'], ['entity_id' => $user->service_id]],
            ['AND', ['entity_type' => 'sector'], ['entity_id' => Sector::find()->select('id')->where(['service_id' => $user->service_id])]],
        ]);
    }

    $dataProvider = new ActiveDataProvider([
        'query' => $query,
    ]);

    $this->load($params);

    if (!$this->validate()) {
        return $dataProvider;
    }

    $query->andFilterWhere(['entity_type' => $this->entity_type])
          ->andFilterWhere(['entity_id' => $this->entity_id]);

    return $dataProvider;
}
}
