<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefTransportasi]].
 *
 * @see \common\models\RefTransportasi
 */
class RefTransportasiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefTransportasi[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefTransportasi|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
