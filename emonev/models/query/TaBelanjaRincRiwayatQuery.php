<?php

namespace emonev\models\query;

/**
 * This is the ActiveQuery class for [[\emusrenbang\models\TaBelanjaRincRiwayat]].
 *
 * @see \emusrenbang\models\TaBelanjaRincRiwayat
 */
class TaBelanjaRincRiwayatQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \emusrenbang\models\TaBelanjaRincRiwayat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\TaBelanjaRincRiwayat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
