<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\TaUserAplikasi]].
 *
 * @see \common\models\TaUserAplikasi
 */
class TaUserAplikasiQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\TaUserAplikasi[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\TaUserAplikasi|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
