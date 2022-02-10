<?php

namespace app\models;

/**
 * This is the ActiveQuery class for [[InfoRiwayat]].
 *
 * @see InfoRiwayat
 */
class InfoRiwayatQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return InfoRiwayat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return InfoRiwayat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
