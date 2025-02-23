<?php

namespace ddmtechdev\user\models\searches;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use ddmtechdev\user\models\Cities;

/**
 * CitiesSearch represents the model behind the search form of `ddmtechdev\user\models\Cities`.
 */
class CitiesSearch extends Cities
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'region_id', 'province_id'], 'integer'],
            [['city_name', 'category_class', 'created_at'], 'safe'],
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
    public function search($params, $formName = null)
    {
        $query = Cities::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params, $formName);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'region_id' => $this->region_id,
            'province_id' => $this->province_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'city_name', $this->city_name])
            ->andFilterWhere(['like', 'category_class', $this->category_class]);

        return $dataProvider;
    }
}
