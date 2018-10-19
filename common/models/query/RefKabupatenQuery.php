<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefKabupaten]].
 *
 * @see \common\models\RefKabupaten
 */
class RefKabupatenQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefKabupaten[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefKabupaten|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
