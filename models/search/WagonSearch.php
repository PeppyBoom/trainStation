<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Wagon;

/**
 * WagonSearch represents the model behind the search form about `app\models\Wagon`.
 */
class WagonSearch extends Wagon
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'type_id', 'enabled', 'deleted'], 'integer'],
            [['number_wagon', 'created_at', 'img_path', 'deleted_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Wagon::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'type_id' => $this->type_id,
            'created_at' => $this->created_at,
            'enabled' => $this->enabled,
            'deleted' => $this->deleted,
            'deleted_at' => $this->deleted_at,
        ]);

        $query->andFilterWhere(['like', 'number_wagon', $this->number_wagon])
            ->andFilterWhere(['like', 'img_path', $this->img_path]);

        return $dataProvider;
    }
}
