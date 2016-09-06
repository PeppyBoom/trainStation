<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 06.09.2016
 * Time: 6:09
 */

namespace app\models;


use yii\base\Model;
use yii\web\UploadedFile;

class UploadImage extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload()
    {
        if ($this->validate() && !empty($this->imageFile->baseName)) {
            $this->imageFile->saveAs('uploads/' . $this->imageFile->baseName . '.' . $this->imageFile->extension);
            return true;
        } else {
            return false;
        }
    }
}