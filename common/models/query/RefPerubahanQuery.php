<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefPerubahan]].
 *
 * @see \common\models\RefPerubahan
 */
class RefPerubahanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefPerubahan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefPerubahan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
