<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefRekAset4]].
 *
 * @see \common\models\RefRekAset4
 */
class RefRekAset4Query extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefRekAset4[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefRekAset4|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
