<?php

namespace emonev\models\query;

/**
 * This is the ActiveQuery class for [[\emusrenbang\models\TaKegiatanApbn]].
 *
 * @see \emusrenbang\models\TaKegiatanApbn
 */
class TaKegiatanApbnQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \emusrenbang\models\TaKegiatanApbn[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \emusrenbang\models\TaKegiatanApbn|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
