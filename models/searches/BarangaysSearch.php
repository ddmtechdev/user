<?php

namespace ddmtechdev\user\models\searches;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use ddmtechdev\user\models\Barangays;

/**
 * BarangaysSearch represents the model behind the search form of `ddmtechdev\user\models\Barangays`.
 */
class BarangaysSearch extends Barangays
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'city_id', 'province_id', 'region_id'], 'integer'],
            [['barangay_name', 'created_at'], 'safe'],
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
        $query = Barangays::find();

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
            'city_id' => $this->city_id,
            'province_id' => $this->province_id,
            'region_id' => $this->region_id,
            'created_at' => $this->created_at,
        ]);

        $query->andFilterWhere(['like', 'barangay_name', $this->barangay_name]);

        return $dataProvider;
    }
}
