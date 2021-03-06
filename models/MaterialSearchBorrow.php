<?php

namespace suPnPsu\material\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use suPnPsu\material\models\Material;

/**
 * MaterialSearch represents the model behind the search form about `suPnPsu\material\models\Material`.
 */
class MaterialSearchBorrow extends MaterialSearch
{
    
    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Material::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);
        
        
        $query->where(['status'=>0]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'status' => $this->status,
            'bought_at' => $this->bought_at,
            'warrant_at' => $this->warrant_at,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'id', $this->id])
            ->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'brand', $this->brand]);

        return $dataProvider;
    }
}
