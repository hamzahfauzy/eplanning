<?php

namespace emusrenbang\models;

use Yii;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $title_seo
 * @property integer $create_at
 * @property integer $update_at
 * @property string $publish_at
 * @property string $username
 * @property integer $view
 * @property integer $hit
 * @property text $file
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'news';
    }

    public $tgl;
    public $bln;
    public $thn;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content','file'], 'string'],
            [['create_at', 'update_at', 'view', 'hit'], 'integer'],
            [['publish_at'], 'safe'],
            [['title', 'title_seo'], 'string', 'max' => 255],
            [['username'], 'string', 'max' => 100],
            [['title_seo'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Judul',
            'content' => 'Isi',
            'title_seo' => 'Judul SEO',
            'create_at' => 'Create At',
            'update_at' => 'Update At',
            'publish_at' => 'Publish At',
            'username' => 'Username',
            'view' => 'View',
            'hit' => 'Hit',
            'file' => 'Gambar',
        ];
    }
}
