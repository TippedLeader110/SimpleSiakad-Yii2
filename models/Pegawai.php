<?php

namespace app\models;

use yii\db\ActiveRecord;
use app\models\Persons;

class Pegawai extends ActiveRecord
{
    public function getPersons(){
        return $this->hasOne(Persons::className(), ['id_person' => 'id_person']);
    }
}