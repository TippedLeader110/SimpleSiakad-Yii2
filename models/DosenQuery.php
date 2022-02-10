<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[Dosen]].
 *
 * @see Dosen
 */
class DosenQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Dosen[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Dosen|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
