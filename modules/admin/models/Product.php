<?php

namespace app\modules\admin\models;

use app\components\helper\TranslateHelper;
use Yii;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $name
 * @property string $content
 * @property double $price
 * @property string $keywords
 * @property string $description
 * @property string $img
 * @property string $hit
 * @property string $new
 * @property string $sale
 * @property string $size
 */
class Product extends \yii\db\ActiveRecord
{

    public $image;
    public $gallery;

    public function behaviors()
    {
        return [
            'image' => [
                'class' => 'rico\yii2images\behaviors\ImageBehave',
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'price'], 'required'],
            [['category_id'], 'integer'],
            [['content', 'hit', 'new', 'sale', 'size', 'color', 'predestination', 'material', 'brand'], 'string'],
            [['price'], 'number'],
            [['name', 'keywords', 'description', 'img', 'alias'], 'string', 'max' => 255],
            [['image'], 'file', 'extensions' => 'png, jpg'],
            [['gallery'], 'file', 'extensions' => 'png, jpg', 'maxFiles' => 4]
        ];
    }

    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    public function getCategoryName(){
        $category = $this->category;
        return $category ? $category->name : 'Самостоятельная категория';
    }


    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID товара',
            'category_id' => 'Категория',
            'name' => 'Название',
            'content' => 'Описание',
            'price' => 'Цена',
            'keywords' => 'Ключевые слова',
            'description' => 'Мета-описание',
            'image' => 'Фото',
            'gallery' => 'Галерея',
            'hit' => 'Хит',
            'new' => 'Новинка',
            'sale' => 'Распродажа',
            'size' => 'Размер',
            'material' => 'Материал',
            'brand' => 'Бренд',
            'predestination' => 'Предназначение',
            'color' => 'Цвет',
            'alias' => 'Алиас'
        ];
    }

    public function deleteImage()
    {
        $path = 'upload/store/'.$this->image->baseName. '.' . $this->image->extension;
        $this->image->removeImage($path);
    }

    public function upload()
    {
        if ($this->validate()) {
            $path = 'upload/store/'.$this->image->baseName. '.' . $this->image->extension;
            $this->image->saveAs($path);
            $this->attachImage($path, true);
            @unlink($path);
            return true;
        } else {
            return false;
        }
    }
    public function uploadGallery()
    {
        if ($this->validate()) {
            foreach ($this->gallery as $file) {
                $path = 'upload/store/'.$file->baseName. '.' . $file->extension;
                $file->saveAs($path);
                $this->attachImage($path);
                @unlink($path);
            }
            return true;
        } else {
            return false;
        }
    }

    public function afterSave($insert, $changedAttributes)
    {
        parent::afterSave($insert, $changedAttributes); // TODO: Change the autogenerated stub
        Yii::$app->db->createCommand('UPDATE product SET alias = :alias WHERE id = :id ',
            ['alias' => TranslateHelper::translit($this->name), 'id' => $this->id])->execute();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductAttributes()
    {
        return $this->hasMany(Attribute::className(), ['id' => 'attribute_id'])->viaTable('value', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductTags()
    {
        return $this->hasMany(ProductTag::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])->viaTable('product_tag', ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getValues()
    {
        return $this->hasMany(Value::className(), ['product_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProductsAttributes()
    {
        return $this->hasMany(Attribute::className(), ['id' => 'attribute_id'])->viaTable('value', ['product_id' => 'id']);
    }



    public static function getSize()
    {
        return [
            1 => 'S',
            2 => 'M',
            3 => 'L',
            4 => 'XL',
            5 => 'XXL'
        ];
    }


}
