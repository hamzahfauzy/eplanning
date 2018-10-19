<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefRekAset3]].
 *
 * @see \common\models\RefRekAset3
 */
class RefRekAset3Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefRekAset3[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefRekAset3|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
