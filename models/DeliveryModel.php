<?php

namespace app\models;

use Yii;
use yii\base\Model;
use app\models\Basket;
use app\models\Image;
use app\models\Price;

use app\models\Usersessitions;

/**
 * ContactForm is the model behind the contact form.
 */
class DeliveryModel  
{
	public $message;
	 	public $textData;
	
 
	
	 public function fillDeliveryDataFromLocalFile(){
		 
		 $mes='fillDeliveryDataFromLocalFile';
		 
		 
		 
		  
  $this->textData= file_get_contents( $_SERVER['DOCUMENT_ROOT'].'/delivery.txt');
	 
	 
	 $this->message= $mes; 
		 
		 
		 
	 }
	 
	 
}
