<?php

namespace userlevel\models;
use yii\base\Model;
use yii\web\UploadedFile;

class TaProfileUpload extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $fileFoto;

    public function rules()
    {
        return [
            [['fileFoto'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg, jpeg', 'maxFiles' => 4],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) { 
            foreach ($this->fileFoto as $file) {
                $file->saveAs('uploads/' . $file->baseName . '.' . $file->extension);
            }
            return true;
        } else {
            return false;
        }
    }
}