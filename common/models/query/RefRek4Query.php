<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefRek4]].
 *
 * @see \common\models\RefRek4
 */
class RefRek4Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefRek4[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefRek4|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
