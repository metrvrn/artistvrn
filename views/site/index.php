<?php

/* @var $this yii\web\View */

use yii\helpers\Html;
use yii\helpers\Url;
use app\models\LokalFileModel;
use app\widgets\CatalogMenu;

$this->title = LokalFileModel::getDataByKeyFromLocalfile('local_data_nameComppany');
$includeAbout = LokalFileModel::getDataByKeyFromLocalfile('use_about') == '1' ? true : false;
?>
<div class="row">
    <div class="col-xs-12 col-md-3">
        <?=CatalogMenu::widget(['model' => $catalogModel])?>
    </div>
    <div class="col-xs-12 col-md-9">
            <?php foreach($akciiModel->arrElements as $index => $item) : ?>
                <div class="index-product-cart">
                    <a href="<?=Url::to(['catalog/index', 'section' => 'non', 'element' => $item['id'], 'page' => 0, 'view' => 'cart'])?>" class="index-product-cart__link">
                        <div class="index-product-cart__title-wrap">
                            <span class="index-product-cart__title"><?=$item['name']?></span>
                        </div>
                        <div class="index-products-cart__image-wrap">
                            <?php $img = "http://database.artistvrn.ru/upload/".$item['imaged'];?>
                            <img class="image-responsive index-products-cart__image" src="<?=$img?>" alt="">
                        </div>
                        <div class="index-products-cart__price-wrap">
                            <span class="index-products-cart__price">
                                <?=$item['price']?>&#8381;
                            </span>
                        </div>
                    </a>
                </div>
            <?php endforeach; ?>
    </div>
</div>
<?php
	if($includeAbout){
		echo $this->render('about');
	}
?>


