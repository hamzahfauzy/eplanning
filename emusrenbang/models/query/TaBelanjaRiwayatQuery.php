<?php

namespace emusrenbang\models\query;

/**
 * This is the ActiveQuery class for [[\emusrenbang\models\TaBelanjaRiwayat]].
 *
 * @see \emusrenbang\models\TaBelanjaRiwayat
 */
class TaBelanjaRiwayatQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \emusrenbang\models\TaBelanjaRiwayat[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\TaBelanjaRiwayat|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
