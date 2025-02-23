<?php

namespace ddmtechdev\user\models\searches;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use ddmtechdev\user\models\Provinces;

/**
 * ProvincesSearch represents the model behind the search form of `ddmtechdev\user\models\Provinces`.
 */
class ProvincesSearch extends Provinces
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'region_id'], 'integer'],
            [['province_name', 'created_at'], 'safe'],
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
        $query = Provinces::find();

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
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'province_name', $this->province_name]);

        return $dataProvider;
    }
}
