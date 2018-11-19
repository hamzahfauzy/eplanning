<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefRek1]].
 *
 * @see \common\models\RefRek1
 */
class RefRek1Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefRek1[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefRek1|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
