<?php

namespace emusrenbang\models;

/**
 * This is the ActiveQuery class for [[TaIndikatorApbn]].
 *
 * @see TaIndikatorApbn
 */
class TaIndikatorApbnQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TaIndikatorApbn[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TaIndikatorApbn|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
