<?php

namespace app\controllers;

use app\models\Category;
use app\models\Product;
use yii\helpers\Url;
use yii\web\Response;

class SitemapController extends AppController
{

    public function actionIndex()
    {
        if (!$xml_sitemap = \Yii::$app->cache->get('sitemap')) {
            $urls = [];

            $categorys = Category::find()->all();
            if (isset($categorys)) {
                foreach ($categorys as $category) {
                    $urls[] = Url::to(['category/view', 'id' => $category->id]);
                }
            }

            $products = Product::find()->all();
            if (isset($products)) {
                foreach ($products as $product) {
                    $urls[] = Url::to(['product/view', 'id' => $product->id]);
                }
            }

            $xml_sitemap = $this->renderPartial('index', [
                'host' => \Yii::$app->request->hostInfo,
                'urls' => $urls
            ]);
            \Yii::$app->cache->set('sitemap', $xml_sitemap, 3600*12);
        }
        header('Content-Type: application/xml');
        \Yii::$app->response->format = Response::FORMAT_XML;
        echo $xml_sitemap;
    }
    
    public function actionView()
    {
        if (!$xml_sitemap = \Yii::$app->cache->get('sitemap_view_l')) {
            $urls = [];

            $categorys = Category::find()->all();
            if (isset($categorys)) {
                foreach ($categorys as $category) {
                    $urls[] = Url::to(['category/view', 'id' => $category->id]);
                }
            }

            $products = Product::find()->all();
            if (isset($products)) {
                foreach ($products as $product) {
                    $urls[] = Url::to(['product/view', 'id' => $product->id]);
                }
            }

            $xml_sitemap = $this->renderPartial('view', [
                'host' => \Yii::$app->request->hostInfo,
                'urls' => $urls
            ]);
            \Yii::$app->cache->set('sitemap_view_l', $xml_sitemap, 3600*12);
        }
        \Yii::$app->response->format = Response::FORMAT_HTML;
        echo $xml_sitemap;
    }


}