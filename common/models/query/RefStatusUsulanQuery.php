<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefStatusUsulan]].
 *
 * @see \common\models\RefStatusUsulan
 */
class RefStatusUsulanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefStatusUsulan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefStatusUsulan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
