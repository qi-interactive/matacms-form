<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\form\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use matacms\form\models\Form;

/**
 * FormSearch represents the model behind the search form about `matacms\form\models\Form`.
 */
class FormSearch extends Form {

    public function rules() {
        return [
            [['Id'], 'integer'],
            [['Name', 'ReferencedTable'], 'safe'],
        ];
    }

    public function scenarios() {
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
    public function search($params) {
        $query = Form::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'Id' => $this->Id,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name])
        ->andFilterWhere(['like', 'ReferencedTable', $this->ReferencedTable]);

        return $dataProvider;
    }
    
}
