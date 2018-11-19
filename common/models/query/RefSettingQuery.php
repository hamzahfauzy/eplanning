<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefSetting]].
 *
 * @see \common\models\RefSetting
 */
class RefSettingQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefSetting[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefSetting|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
