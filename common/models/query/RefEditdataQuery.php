<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefEditdata]].
 *
 * @see \common\models\RefEditdata
 */
class RefEditdataQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefEditdata[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefEditdata|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
