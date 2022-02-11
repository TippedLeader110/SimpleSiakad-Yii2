<?php

namespace app\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "jenis_riwayat".
 *
 * @property int $id_jenisriwayat
 * @property string $nama_jenisriwayat
 *
 * @property InfoRiwayat[] $infoRiwayats
 */
class JenisRiwayat extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'jenis_riwayat';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama_jenisriwayat'], 'required'],
            [['nama_jenisriwayat'], 'string', 'max' => 32],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_jenisriwayat' => 'Id Jenisriwayat',
            'nama_jenisriwayat' => 'Nama Kategori Riwayat',
        ];
    }

    public function getJenisItems()
    {
        $items = $this->find()->all();
        $items = ArrayHelper::map($items, 'id_jenisriwayat', 'nama_jenisriwayat');
        return $items;
    }

    /**
     * Gets query for [[InfoRiwayats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getInfoRiwayats()
    {
        return $this->hasMany(InfoRiwayat::className(), ['id_jenisriwayat' => 'id_jenisriwayat']);
    }
}
