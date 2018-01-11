<?php


namespace app\models;


use yii\base\Model;
use yii\web\UploadedFile;

class ImageUpload extends Model
{
    /**
     * image
     * @var integer
     */
    public $image;

    public function rules()
    {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png,jpeg']
        ];
    }


    /**
     * Save image to directory
     * @param UploadedFile $file
     */
    public function uploadFile(UploadedFile $file, $currentImage)
    {
        $this->image = $file;

        if ($this->validate()) {
            $this->deleteCurrentImage($currentImage);
            return $this->saveImage();
        }
    }



    /**
     * Return alias folder to image
     * @return bool|string
     */
    private function getFolder()
    {
        return \Yii::getAlias('upload/store/blog/');
    }

    /**
     * Get filename correct
     * @return string
     */
    private function generateFilename()
    {
        return strtolower(md5(uniqid($this->image->baseName)) . '.' . $this->image->extension);
    }


    /**
     * Delete folder current image
     * @param $currentImage
     */
    public function deleteCurrentImage($currentImage)
    {
        if ($this->fileExist($currentImage) && is_file($this->fileExist($currentImage))) {
            unlink($this->getFolder() . $currentImage);
        }
    }

    /**
     * Return bool file exist
     * @param $currentImage
     * @return bool
     */
    public function fileExist($currentImage)
    {
        return file_exists($this->getFolder() . $currentImage);
    }


    /**
     * Save in folder image
     * @return string
     */
    public function saveImage()
    {
        $filename = $this->generateFilename();
        $this->image->saveAs($this->getFolder() . $filename, false);
        return $filename;
    }


}