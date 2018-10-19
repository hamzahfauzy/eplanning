<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "menu".
 *
 * @property integer $id
 * @property string $namaMenu
 * @property integer $aplikasi
 * @property integer $parent
 */
class Menu extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['namaMenu', 'aplikasi'], 'required'],
            [['aplikasi', 'parent'], 'integer'],
            [['namaMenu'], 'string', 'max' => 150],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'namaMenu' => 'Nama Menu',
            'aplikasi' => 'Aplikasi',
            'parent' => 'Parent',
        ];
    }
}
