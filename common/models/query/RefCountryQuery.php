<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\RefCountry]].
 *
 * @see \common\models\RefCountry
 */
class RefCountryQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return \common\models\RefCountry[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \common\models\RefCountry|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
