<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\TaHonor]].
 *
 * @see \common\models\TaHonor
 */
class TaHonorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\TaHonor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\TaHonor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
