<?php

namespace emusrenbang\models\query;

/**
 * This is the ActiveQuery class for [[\emusrenbang\models\TaProgramRiwayat]].
 *
 * @see \emusrenbang\models\TaProgramRiwayat
 */
class TaProgramRiwayatQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \emusrenbang\models\TaProgramRiwayat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\TaProgramRiwayat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
