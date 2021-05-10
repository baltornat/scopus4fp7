<?php

namespace app\models;

use app\models\PublicationsPublication;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * PublicationsPublicationSearch represents the model behind the search form of `app\models\PublicationsPublication`.
 */
class PublicationsPublicationSearch extends PublicationsPublication
{
    public $authors;
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'citedby', 'project_ppi'], 'integer'],
            [['eid', 'doi', 'title', 'issn', 'eissn', 'pubdate', 'pubdate_text', 'pubname', 'pubtype', 'funding_agency_acronym', 'funding_agency_id', 'funding_agency_name', 'citedby_link', 'author_scopus_id', 'authors'], 'safe'],
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
    public function search($params, $model)
    {
        $query = PublicationsPublication::find()
            ->select(["publication.*", "abstract.*", "STRING_AGG(DISTINCT(CONCAT(keyword.keyword, '@', keyword.language)), ' | ') AS keywords", "STRING_AGG(DISTINCT(CONCAT(author.authid, '@', authname, '@', affiliation.afid, '@', affiliation.afname, '@', affiliation.afcity, '@', affiliation.afcountry)), ' | ') AS authors"])
            ->joinWith('publicationsAuthor')
            ->joinWith('publicationsAbstract')
            ->joinWith('publicationsKeyword')
            ->joinWith('publicationsAffiliation')
            ->where(['author_scopus_id'=>$model->author_scopus_id, 'project_ppi'=>$model->project_ppi])
            ->groupBy(['publication.id','eid','title','pubdate','citedby', 'abstract.pubid', 'abstract.language']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'citedby' => $this->citedby,
            'project_ppi' => $this->project_ppi,
        ]);

        $query->andFilterWhere(['ilike', 'eid', $this->eid])
            ->andFilterWhere(['ilike', 'doi', $this->doi])
            ->andFilterWhere(['ilike', 'title', $this->title])
            ->andFilterWhere(['ilike', 'issn', $this->issn])
            ->andFilterWhere(['ilike', 'eissn', $this->eissn])
            ->andFilterWhere(['ilike', 'pubdate_text', $this->pubdate_text])
            ->andFilterWhere(['ilike', 'CAST(pubdate AS text)', $this->pubdate])
            ->andFilterWhere(['ilike', 'pubname', $this->pubname])
            ->andFilterWhere(['ilike', 'pubtype', $this->pubtype])
            ->andFilterWhere(['ilike', 'funding_agency_acronym', $this->funding_agency_acronym])
            ->andFilterWhere(['ilike', 'funding_agency_id', $this->funding_agency_id])
            ->andFilterWhere(['ilike', 'funding_agency_name', $this->funding_agency_name])
            ->andFilterWhere(['ilike', 'citedby_link', $this->citedby_link])
            ->andFilterWhere(['ilike', 'author_scopus_id', $this->author_scopus_id]);

        return $dataProvider;
    }
}
