<?php

use yii\db\Migration;

/**
 * Handles the creation of table `article_comment`.
 */
class m180104_185629_create_article_comment_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('article_comment', [
            'id' => $this->primaryKey(),
            'text'=>$this->string(),
            'user_id'=>$this->integer(),
            'article_id'=>$this->integer(),
            'status'=>$this->integer()
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            'idx-post-user_id',
            'article_comment',
            'user_id'
        );

        $this->addForeignKey(
            'fk-post-user_id',
            'article_comment',
            'user_id',
            'article_user',
            'id',
            'CASCADE'
        );

        // creates index for column `article_id`
        $this->createIndex(
            'idx-article_id',
            'article_comment',
            'article_id'
        );

        // add foreign key for table `article`
        $this->addForeignKey(
            'fk-article_id',
            'article_comment',
            'article_id',
            'article',
            'id',
            'CASCADE'
        );
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('article_comment');
    }
}
