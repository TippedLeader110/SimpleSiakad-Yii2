<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "persons".
 *
 * @property int $id_person
 * @property string $nama
 * @property int $nik
 * @property int $jk
 * @property string $tgl_lahir
 * @property string $tempat_lahir
 *
 * @property Dosen $dosen
 * @property InfoRiwayat[] $infoRiwayats
 * @property Mahasiswa $mahasiswa
 * @property Pegawai $pegawai
 */
class Persons extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'persons';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'nik', 'jk', 'tgl_lahir', 'tempat_lahir'], 'required'],
            [['nik', 'jk'], 'integer'],
            [['tgl_lahir'], 'safe'],
            [['nama'], 'string', 'max' => 124],
            [['tempat_lahir'], 'string', 'max' => 32],
            [['nik'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_person' => 'Id Person',
            'nama' => 'Nama',
            'nik' => 'NIK',
            'jk' => 'Jenis Kelamin',
            'tgl_lahir' => 'Tanggal Lahir',
            'tempat_lahir' => 'Tempat Lahir',
        ];
    }

    public function getJk(){
        if($this->jk==1){
            return "Laki-Laki";
        }else{
            return "Perempuan";
        }
    }

    /**
     * Gets query for [[Dosen]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getDosen()
    {
        return $this->hasOne(Dosen::className(), ['id_person' => 'id_person']);
    }

    /**
     * Gets query for [[InfoRiwayats]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getInfoRiwayats()
    {
        return $this->hasMany(InfoRiwayat::className(), ['id_person' => 'id_person']);
    }

    /**
     * Gets query for [[Mahasiswa]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getMahasiswa()
    {
        return $this->hasOne(Mahasiswa::className(), ['id_person' => 'id_person']);
    }

    /**
     * Gets query for [[Pegawai]].
     *
     * @return \yii\db\ActiveQuery|yii\db\ActiveQuery
     */
    public function getPegawai()
    {
        return $this->hasOne(Pegawai::className(), ['id_person' => 'id_person']);
    }

    /**
     * {@inheritdoc}
     * @return PersonsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PersonsQuery(get_called_class());
    }
}
