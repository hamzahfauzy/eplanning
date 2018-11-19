<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\TaMusrenbangKelurahanMedia]].
 *
 * @see \common\models\TaMusrenbangKelurahanMedia
 */
class TaMusrenbangKelurahanMediaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\TaMusrenbangKelurahanMedia[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\TaMusrenbangKelurahanMedia|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
