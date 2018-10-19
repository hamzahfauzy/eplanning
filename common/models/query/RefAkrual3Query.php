<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefAkrual3]].
 *
 * @see \common\models\RefAkrual3
 */
class RefAkrual3Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefAkrual3[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefAkrual3|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
