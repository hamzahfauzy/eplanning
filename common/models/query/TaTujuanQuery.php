<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\TaTujuan]].
 *
 * @see \common\models\TaTujuan
 */
class TaTujuanQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\TaTujuan[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\TaTujuan|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
