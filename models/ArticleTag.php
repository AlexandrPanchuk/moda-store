<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "article_tag".
 *
 * @property integer $id
 * @property string $title
 *
 * @property ArticleArticleTag[] $articleArticleTags
 */
class ArticleTag extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article_tag';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticleArticleTags()
    {
        return $this->hasMany(ArticleArticleTag::className(), ['tag_id' => 'id']);
    }
}
