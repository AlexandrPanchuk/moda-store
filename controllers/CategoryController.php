<?php

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\web\HttpException;

class CategoryController extends AppController
{
    public function actionIndex()
    {
        $hits = Product::getDb()->cache(function () {
          return Product::find()->where(['hit' => '1'])->limit(6)->all();
        });

        $news = Product::getDb()->cache(function () {
          return Product::find()->where(['new' => '1'])->limit(6)->all();
        });
        
        $this->setMeta(
            'Визажные инструменты, клатчи, женские сумки, резинки и заколки: купить в Киеве и других городах Украины по выгодной цене — imoda-store.com',
            '',
            'Интернет магазин визажных инструментов, женсих сумок, заколок,  imoda-store.com | ✔Выгодные цены ✔Отличное качество ✔Доставка по Украине! ☎ +38 (063) 314-89-62'
        );
        return $this->render('index', compact('hits', 'news'));
    }

    public function actionView($id)
    {

        $category = Category::getDb()->cache(function () use ($id) {
           return Category::findOne(['id' => $id]);
        });

        if ($category) {
            $this->view->params['breadcrumbs'] = [
                ['label' => $category->name]
            ];
        }

        $this->setMeta(
            $category->name.' - купить в Киеве и Украине, цены на '.$category->name.' в каталоге 2017 интернет магазина imoda-store.com' ,
            $category->keywords,
            $category->name.' – лучший интернет шопинг для Вас в магазине imoda-store.com! ✓ Качество! ✓ Доступность! ✓ Быстрая доставка! Звоните ☎ +38 (063) 314-89-62');

        return $this->render('view', compact('id'));
    }


    public function actionSearch()
    {
        $queryUser = trim( Yii::$app->request->get('queryUser'));
        $products = null;

        if (!$queryUser) {
            $pages = null;
            return $this->render('search', ['pages' => $pages, 'queryUser' => $queryUser, 'products' => $products]);
        }

        $query = Product::find()->where(['like', 'name', $queryUser]);
        $pages = new Pagination([
            'totalCount' => $query->count(),
            'pageSize' => 6,
            'forcePageParam' => false,
            'pageSizeParam' => false
        ]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();

        return $this->render('search', compact('products', 'pages', 'queryUser'));
    }



}