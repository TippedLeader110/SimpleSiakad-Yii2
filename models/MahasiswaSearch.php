<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Mahasiswa;

/**
 * PersonsSearch represents the model behind the search form of `app\models\Persons`.
 */
class MahasiswaSearch extends Mahasiswa{

    public $nama;
    public $tgl_lahir;
    public $tempat_lahir;
    public $nik;

    public function rules()
    {
        return [
            [['id_person'], 'integer'],
            [['tanggal_menikah', 'status_menikah', 'nama', 'tgl_lahir', 'tempat_lahir', 'nik'], 'safe'],
        ];
    }

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
        $query = Mahasiswa::find()->innerJoinWith('persons', 'persons.id_person = mahasiswa.id_person')->where(["persons.role" => 2]);

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
            'id_person' => $this->id_person,
            'status_menikah' => $this->status_menikah,
            'tanggal_menikah' => $this->tanggal_menikah,
        ]);

        $query->andFilterWhere(['like', 'persons.nama', $this->nama])
            ->andFilterWhere(['like', 'persons.tgl_lahir', $this->tgl_lahir])
            ->andFilterWhere(['like', 'persons.nik', $this->nik])
            ->andFilterWhere(['like', 'persons.tempat_lahir', $this->tempat_lahir])
            ->andFilterWhere(['like', 'tanggal_menikah', $this->tanggal_menikah]);

        return $dataProvider;
    }

}

?>