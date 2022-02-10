<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mahasiswa".
 *
 * @property int $id_mahasiswa
 * @property int $id_person
 * @property int $status_menikah
 * @property string|null $tanggal_menikah
 *
 * @property Persons $person
 */
class Mahasiswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mahasiswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_person'], 'required'],
            [['id_person', 'status_menikah'], 'integer'],
            [['tanggal_menikah'], 'safe'],
            [['id_person'], 'unique'],
            [['id_person'], 'exist', 'skipOnError' => true, 'targetClass' => Persons::className(), 'targetAttribute' => ['id_person' => 'id_person']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_mahasiswa' => 'Id Mahasiswa',
            'id_person' => 'Id Person',
            'status_menikah' => 'Status Menikah',
            'tanggal_menikah' => 'Tanggal Menikah',
        ];
    }

    /**
     * Gets query for [[Person]].
     *
     * @return \yii\db\ActiveQuery|PersonsQuery
     */
    public function getPersons()
    {
        return $this->hasOne(Persons::className(), ['id_person' => 'id_person']);
    }

    /**
     * {@inheritdoc}
     * @return MahasiswaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MahasiswaQuery(get_called_class());
    }
}
