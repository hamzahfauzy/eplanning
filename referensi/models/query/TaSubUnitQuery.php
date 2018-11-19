<?php

namespace referensi\models\query;

/**
 * This is the ActiveQuery class for [[\referensi\models\TaSubUnit]].
 *
 * @see \referensi\models\TaSubUnit
 */
class TaSubUnitQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \referensi\models\TaSubUnit[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \referensi\models\TaSubUnit|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
