<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "info_riwayat".
 *
 * @property int $id_riwayat
 * @property int $id_person
 * @property int $jenis_role
 * @property int $id_jenisriwayat
 * @property int $riwayat
 * @property string $tgl_riwayat
 *
 * @property JenisRiwayat $jenisriwayat
 * @property Persons $person
 */
class InfoRiwayat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'info_riwayat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_person', 'jenis_role', 'id_jenisriwayat', 'riwayat', 'tgl_riwayat'], 'required'],
            [['id_person', 'jenis_role', 'id_jenisriwayat', 'riwayat'], 'integer'],
            [['tgl_riwayat'], 'safe'],
            [['id_person'], 'exist', 'skipOnError' => true, 'targetClass' => Persons::className(), 'targetAttribute' => ['id_person' => 'id_person']],
            [['id_jenisriwayat'], 'exist', 'skipOnError' => true, 'targetClass' => JenisRiwayat::className(), 'targetAttribute' => ['id_jenisriwayat' => 'id_jenisriwayat']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_riwayat' => 'Id Riwayat',
            'id_person' => 'Id Person',
            'jenis_role' => 'Jenis Role',
            'id_jenisriwayat' => 'Id Jenisriwayat',
            'riwayat' => 'Riwayat',
            'tgl_riwayat' => 'Tgl Riwayat',
        ];
    }

    /**
     * Gets query for [[Jenisriwayat]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getJenisriwayat()
    {
        return $this->hasOne(JenisRiwayat::className(), ['id_jenisriwayat' => 'id_jenisriwayat']);
    }

    /**
     * Gets query for [[Person]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Persons::className(), ['id_person' => 'id_person']);
    }
}
