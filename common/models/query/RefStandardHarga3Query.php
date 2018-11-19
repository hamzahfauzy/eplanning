<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefStandardHarga3]].
 *
 * @see \common\models\RefStandardHarga3
 */
class RefStandardHarga3Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefStandardHarga3[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefStandardHarga3|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
