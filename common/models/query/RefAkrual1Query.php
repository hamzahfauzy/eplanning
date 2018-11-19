<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefAkrual1]].
 *
 * @see \common\models\RefAkrual1
 */
class RefAkrual1Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefAkrual1[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefAkrual1|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
