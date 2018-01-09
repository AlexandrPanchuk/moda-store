<?php
/* @var $this yii\web\View */
use app\components\helper\PriceHelper;
use yii\helpers\Html;
?>
<section id="slider"><!--slider-->
    <div class="container">
        <div class="row">
            <div class="col-sm-12">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
                        <li data-target="#slider-carousel" data-slide-to="1"></li>
                        <!--<li data-target="#slider-carousel" data-slide-to="2"></li>-->
                    </ol>

                    <div class="carousel-inner">
                        <div class="item active">
                            <div class="col-sm-6">
                                <h1><span>I</span>MODA-STORE</h1>
                                
                                <!--<h2>Детская одежда</h2>-->
                                <p>
                                Добро пожаловать в интернет-магазин I Moda-Store!</p> 
                                <p style="
                                      font-family: 'Didact Gothic', sans-serif;
                                      color: #555555;
                                      font-size: 14px;
                                      line-height: 22px;
                                      
                                " >Качественный макияж, очень важен для любой красивой женщины. Подбирайте правильно косметику по уходу за кожей вашего лица в нашем интернет магазине. В наличии: наборы кистей, спонжи, наборы для макияжа и др.</p>
                                <a href="/category/kistochki-dlya-makiyaja"><button type="button" class="btn btn-default get">Перейти в категорию</button></a>
                            </div>
                            <div class="col-sm-6">
                                 <img src="/web/images/home/widget1.jpg" class="girl img-responsive" alt="" />
                            
                            </div>
                        </div>
                        <div class="item">
                            <div class="col-sm-6">
                                <br>
                                <h2>Женские сумки и клатчи</h2>
                                <p style="font-family: 'Didact Gothic', sans-serif;
                                      color: #555555;
                                      font-size: 14px;
                                      line-height: 22px;">
                                    Интернет – магазин «I Moda Store» готов предложить вам обширный выбор женских сумок и клатчей на любой вкус. У нас можно купить прекрасный подарок близкому человеку, другу или коллеге – качественный функциональный кошелек. В наличии изделия различных цветов и оттенков.  
                                </p>
                                <a href="/category/kosmetichki-i-koshelki"><button type="button" class="btn btn-default get">Перейти в категорию</button></a>
                            </div>
                            <div class="col-sm-6">
                               <img src="/web/images/home/widget22.jpg" class="girl img-responsive" alt="" />
                            
                            </div>
                        </div>

                        <!--<div class="item">-->
                        <!--    <div class="col-sm-6">-->
                        <!--        <h1><span>I</span>MODA-STORE</h1>-->
                        <!--        <h2>Free Ecommerce Template</h2>-->
                        <!--        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. </p>-->
                        <!--        <button type="button" class="btn btn-default get">Get it now</button>-->
                        <!--    </div>-->
                        <!--    <div class="col-sm-6">-->
                        <!--        <img src="/web/images/home/girl3.jpg" class="girl img-responsive" alt="" />-->
                        <!--        <img src="/web/images/home/pricing.png" class="pricing" alt="" />-->
                        <!--    </div>-->
                        <!--</div>-->

                    </div>

                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>

            </div>
        </div>
          <?=\app\components\widgets\IndexCatalogWidget::widget()?>
    </div>
</section><!--/slider-->

<section>
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <div class="left-sidebar">
                    <h2>Меню категорий</h2>
                    <div class="nestedsidemenu">
                        <ul>
                            <?= \app\components\NewMenuWidget::widget(['tpl' => 'new_menu']) ?>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="col-sm-9 padding-right">
                <?php if (!empty($hits)): ?>
                <div class="features_items"><!--features_items-->
                    <h2 class="title text-center">Популярные товары</h2>
                    <?php $i=0; foreach ($hits as $hitItem): ?>
                    <?php $mainImg = $hitItem->getImage(); ?>

                        <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">

                                    <a href="<?=\yii\helpers\Url::to(['product/view', 'id' => $hitItem->id])?>">
                                        <?=Html::img($mainImg->getUrl(), ['alt' => $hitItem->name])?>
                                    </a>

                                    <span class="price"><?=PriceHelper::from($hitItem['price'])?></span>
                                    <p><a href="<?=\yii\helpers\Url::to(['product/view', 'id' => $hitItem['id']])?>"><?=$hitItem['name']?></a></p>
                                    <!--                                    <p>Страна производитель: Украина</p>-->
                                    <a href="<?=\yii\helpers\Url::to(['cart/add', 'id'=>$hitItem['id']])?>" data-id="<?=$hitItem['id']?>" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Добавить в корзину</a>
                                </div>
                                <?= Html::img("@web/images/home/new.png", ['class' => 'new']) ?>
                            </div>
                        </div>
                    </div>
                        <?php $i++; ?>
                        <?php if ($i % 3 == 0): ?>
                            <div class="clearfix"></div>
                        <?php endif; ?>

                    <?php endforeach; ?>

                </div><!--features_items-->
                <?php endif; ?>

                <div class="recommended_items">
                    <h2 class="title text-center">Рекомендованные товары</h2>
                    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
                        <div class="carousel-inner">
                            <?php $count = count($news); $i = 0; foreach ($news as $new): ?>
                                <?php if ($i % 3 == 0): ?>
                                    <div class="item <?php if ($i == 0) echo "active"?>">
                                <?php endif; ?>

                                <?php
                                    $mainImgs = $new->getImage();
                                ?>
                                <div class="col-sm-4">
                                    <div class="product-image-wrapper">
                                        <div class="single-products">
                                            <div class="productinfo text-center">
                                                    <a href="<?=\yii\helpers\Url::to(['product/view', 'id' => $new->id])?>">
                                                        <?=Html::img($mainImgs->getUrl(), ['alt' => $new->name])?>
                                                    </a>
                                                <span class="price"><?= PriceHelper::from($new->price)?></span>
                                                <p><a href="<?=\yii\helpers\Url::to(['product/view', 'id' => $new->id])?>"><?=$new->name?></a></p>
                                                <button type="button" class="btn btn-default add-to-cart" data-id="<?=$new->id?>"><i class="fa fa-shopping-cart"></i>Добавить в корзину</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php $i++; ?>
                                <?php if ($i % 3 == 0 || $count == $i): ?>
                                    </div>
                                <?php endif; ?>
                            <?php endforeach; ?>
                        </div>
                        <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
                
            </div>
        <p>
            <div class="front-text col-sm-12">
            Если Вы ещё не знаете чем побаловать и приятно удивить себя или близкого человека – предлагаем Вам заглянуть в интернет-магазин  imoda-store.com. Наша миссия – дарить частичку красоты и радости для каждого нашего клиента, к тому же  ни для кого не секрет, что внешность – это наша визитная карточка и красивый аккуратный макияж и хорошо подобранные аксессуары играют важную роль в создании правильного имиджа.</p>
            
<p>В нашем интернет-магазине Вы сможете найти все необходимые вещи для «женского тюнинга» - от кисточек для нанесения макияжа до кошельков и клатчей. Широкий ассортимент не даст Вам заскучать и удивит разнообразием форм и цветов, а также наши товары приятно удивят Вас своим удобством и функциональностью. Гарантируем, что Вы будете приятно удивлены ценами на товары в нашем интернет магазине – теперь Вы не будете стоять перед выбором купить себе классную кисть для тона или новую красивую косметичку, которая давно находиться в хотелках. Мы сделали всё для того, чтобы Ваш бьюти-шоппинг был не только приятным, полезным, но и лёгким – для Вас и Вашего кошелька.</p>
<p>В нашем интернет-магазине Вы можете стать  обладателем:</p>
<ul>
<li style="list-style: circle;">Инструментов для создания красоты – аксессуаров для макияжа. Ни один шикарный макияж не может быть создан без хороших кистей и спонжев! Аккуратно нанесенный тон без разводов, красиво растушеванные тени, идеальные стрелки – это именно их заслуга. А как приятно, когда не нужно заморачиватся над макияжем и процесс его нанесения превращается не в надоедливое рутинное дело, а в настоящее искусство! Для самых продвинутых мастеров визажа у нас на сайте есть подраздел «Наборы для макияжа» где Вы можете приобрести сразу целый арсенал инструментов для создания роскошных образов.</li>

<li style="list-style: circle;">Аксессуаров для волос. Шикарный макияж не может обойтись без красивой укладки, а красивая укладка нуждается в полезных и приятных глазу мелочах. В данном разделе Вы можете приобрести всё самое необходимое для создания женственной причёски.</li>

<li style="list-style: circle;">Сумок и рюкзаков. Одна сумочка – это хорошо, две – лучше, три – ещё лучше…И вообще, сумок, как и туфель,  много не бывает! Играйте с образами и будьте уникальными и оригинальными.</li>

<li style="list-style: circle;">Косметичек и кошельков. Отсутствие данных аксессуаров усложняет взаимодействие с предметами, которые в них должны хранится и создаёт хаос на Вашем косметическом столике и в Ваших сумочках! Теперь не нужно полчаса искать любимую помаду в сумочке или злиться, стоя в очереди в поиске нужной карточки, – практичные и презентабельные косметички и кошельки сделают Вашу жизнь легче и приятнее.</li>
</ul>

<p>Как видите – шопинг у нас одно удовольствие, а в удовольствиях себе отказывать нельзя! Будем всегда рады видеть Вас у нас на сайте! Будьте красивыми -  ведь красота не роскошь, а необходимость!</p> <br> <br> </div>
        </div>
    </div>
</section>