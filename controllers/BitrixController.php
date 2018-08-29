<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\CatalogModel;
use app\models\AjaxModel;
use app\models\BitrixModel;

 
use app\models\Order; 
use app\models\Basket;
use app\models\Element;
use app\models\User;

class BitrixController  extends Controller
{
      
	 public $defaultAction = 'index';
	
	
	
    public function actionIndex()
    {
		$model=new BitrixModel();
	    $this->layout = 'ajaxl';
			
			$model->message='sucsses';
		   return $this->render('bitrix', [
         'model' => $model,
			]);
			
    }
 
	  
	///1c_ex
 
	  public function actionBitrix()
    {
		
		
		
		$model=new BitrixModel();
	    $this->layout = 'ajaxl';
			
			
			
			
			$g=Yii::$app->request->get();
			
			
			
			if(isset($g)&&$g['type']=='sale'&& $g['mode']=="init"){
				
				$model->message='zip=no'."<br>".'file_limit=64000';
				
				
			};
			
				if(isset($g)&&$g['type']=='sale'&& $g['mode']=="checkauth"){
				
				$model->message='success';
				
				
			};
			
			
				if(isset($g)&&$g['type']=='sale'&& $g['mode']=="success"){
				
				$model->message='success';
				
				
			};
			
			
			if(isset($g)&&$g['type']=='sale'&& $g['mode']=="query"){
				
				
				$model=new BitrixModel();
				$model->message='';
				
				$model->findOne();
				if(isset($model->order)){}else{
					  return $this->render('bitrix', [
                     'model' => $model,
				]);
				}
				$model->fillHeader();
				$model->fillBasket();
				$model->fillFooter();
				
				//echo 'alex';
				
				

				
			};
			
			
		   return $this->render('bitrix', [
         'model' => $model,
			]);
			
    }
 
	
		  public function actionBitrixgetxmlcode(){
			  
			  	$model=new BitrixModel();
				$model->Bitrixgetxmlcode(); 
			  
			  
			    return $this->render('bitrix', [
                 'model' => $model,]);
			  
		  }
	
	

	
}


?>
