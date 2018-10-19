<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefHonor]].
 *
 * @see \common\models\RefHonor
 */
class RefHonorQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefHonor[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefHonor|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
