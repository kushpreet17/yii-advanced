<?php
namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Students;

/**
 * StudentSearch represents the model behind the search form about `common\models\Students`.
 */
class StudentSearch extends Students
{
   /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['student_id', 'country_id', 'state_id'], 'integer'],
            [['student_name', 'gender', 'address_1', 'address_2', 'updated_at', 'created_at'], 'safe'],
            
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
        $query = Students::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            ]);
      // $query->joinWith(['students', 'countries']);

       
       $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->andFilterWhere([
            'student_id' => $this->student_id,
            'country_id' => $this->country_id,
            'state_id' => $this->state_id,
            'updated_at' => $this->updated_at,
            'created_at' => $this->created_at,
        ]);
        $query->andFilterWhere(['like', 'student_name', $this->student_name])
             ->andFilterWhere(['like', 'gender', $this->gender])
            ->andFilterWhere(['like', 'address_1', $this->address_1])
            ->andFilterWhere(['like', 'address_2', $this->address_2]);
           //->andFilterWhere(['like', 'country.country_name', $this->country_id]);      
            return $dataProvider;
    }
}
