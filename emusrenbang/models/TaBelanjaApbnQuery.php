<?php

namespace emusrenbang\models;

/**
 * This is the ActiveQuery class for [[TaBelanjaApbn]].
 *
 * @see TaBelanjaApbn
 */
class TaBelanjaApbnQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return TaBelanjaApbn[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return TaBelanjaApbn|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
