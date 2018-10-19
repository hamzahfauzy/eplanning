<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefAkrual4]].
 *
 * @see \common\models\RefAkrual4
 */
class RefAkrual4Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefAkrual4[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefAkrual4|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
