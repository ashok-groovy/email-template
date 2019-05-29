<?php

namespace vendor\groovy\src\email\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use vendor\groovy\src\email\models\EmailTemplate;

/**
 * EmailTemplateSearch represents the model behind the search form of `common\models\EmailTemplate`.
 */
class EmailTemplateSearch extends EmailTemplate
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['emai_template_name', 'email_status', 'email_slug','email_subject','email_available_tags'], 'safe'],
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
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = EmailTemplate::find();

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
        ]);

        $query->andFilterWhere(['like', 'emai_template_name', $this->emai_template_name])
            ->andFilterWhere(['like', 'email_status', $this->email_status])
            ->andFilterWhere(['like', 'email_subject', $this->email_subject])
            ->andFilterWhere(['like', 'email_slug', $this->email_slug]);

        return $dataProvider;
    }
}
