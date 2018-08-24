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
class AboutModel extends Model
{
	public $message;
	public $textData;
	 
   
     public function fillAboutDataFromLocalFile() 
     {   $mes='';
	 
	 
	 
	 
	 
	 
  $this->textData= file_get_contents( $_SERVER['DOCUMENT_ROOT'].'/about.txt');
	 
         $this->message= $mes;
     }
	 
	  
	 
	 
}
