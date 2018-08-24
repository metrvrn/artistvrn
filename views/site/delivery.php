<?php

/* @var $this yii\web\View */

use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\CatalogMenu;

$this->title = 'Доставка оплата';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="row">
    <div class="col-xs-12 col-md-3">
        <?///=CatalogMenu::widget(['model' => $catalogModel])?>
    </div>
    <div class="col-xs-12 col-md-9">
        <h1><?= Html::encode($this->title) ?></h1>
         
		    <?echo $model->textData?> 
    </div>
</div>
 
 