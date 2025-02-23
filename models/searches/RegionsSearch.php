<?php

namespace ddmtechdev\user\models\searches;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use ddmtechdev\user\models\Regions;

/**
 * RegionsSearch represents the model behind the search form of `ddmtechdev\user\models\Regions`.
 */
class RegionsSearch extends Regions
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['region_code', 'region_name', 'created_at'], 'safe'],
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
        $query = Regions::find();

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
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'region_code', $this->region_code])
            ->andFilterWhere(['like', 'region_name', $this->region_name]);

        return $dataProvider;
    }
}
