<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefAkrual5]].
 *
 * @see \common\models\RefAkrual5
 */
class RefAkrual5Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefAkrual5[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefAkrual5|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
