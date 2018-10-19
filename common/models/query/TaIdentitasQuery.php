<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\TaIdentitas]].
 *
 * @see \common\models\TaIdentitas
 */
class TaIdentitasQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\TaIdentitas[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\TaIdentitas|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
