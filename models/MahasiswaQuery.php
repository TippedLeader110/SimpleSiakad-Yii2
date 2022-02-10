<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Mahasiswa]].
 *
 * @see Mahasiswa
 */
class MahasiswaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Mahasiswa[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Mahasiswa|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
