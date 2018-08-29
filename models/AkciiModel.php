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
class AkciiModel extends Model
{
	public $message;
	
	public   $arrElements;
	
    public   $arrElementsImage;
	public   $arrElementsImageDetail;
	public   $arrElementsPrice; 
	public   $arrElementsQuantity; 
	
      //add element to bssket
 

    /**
     * @return array the validation rules.
     */
   public function rules()
    {
        return [
                [['elementForAddToBasket', 'sessionForBasket', 'userId','quantityForAddToBasket'], 'safe'],
       ];
    }

   
     public function FillarrElements(){
		 
		 
		 $elementsAkcii=Akcii::find()
		 ->all();
		 
		// print_r( $elementsAkcii);
		 
		 
		 $k=0;
		 $arrayEl=[];
		 $arrayXmlElement=[];
		 while(count($arrayXmlElement)<13){
			
			  $i=rand(0,45);
			  $intArray=[];
			  $intArray['id']= $elementsAkcii[$i]->id;			
			  $intArray['xmlcode']= $elementsAkcii[$i]->xmlcode;	
			 
			 $arrayXmlElement[]=  $intArray['xmlcode'];
			 $arrayEl[]=$intArray; 		 
			 
		 }
		 
		 print_r($arrayXmlElement);
		 
		 
		 $elements = Element::find()
		->where(['xmlcode' =>$arrayXmlElement ]) 
		->orderBy("name")			 
		//->where(['idp' =>ltrim(  $startCode )])
		->all();
		 
		 
		 foreach($elements as $element){
			$idArray=Array();
			//echo $element->id;
			
			//we do not make the tree in this function
			// echo 'ffff <br>';
			$idArray[ 'id']= $element->id;
			$idArray[ 'name']= $element->name;
			$idArray[ 'code']= $element->code;
			$idArray[ 'index1']= $element->index1;
			$idArray[ 'index2']= $element->index2;
			$idArray[ 'idp']= $element->idp;
			
			
			$this->arrElements[]=$idArray;
		};
		 
		 
		 
	 //print_r(   $this->arrElements);
		 
	 }
	 
	 
	 
	public function fillImageForElementArray(){
		
		$this->arrElementsImage=[];
		
		$this->arrElementsImageDetail=[];
		
		$elementid=[];
		
		foreach($this->arrElements as $element){
			$elementid[]=$element['id'];
			
		}
		// $elementid=$this->elementIdArray;
		
		
		if( count($elementid)>0 ){
			
			
			
			// $imageAr=[];
			
			
			$images=Image::find()
			->where(['elementid'=>$elementid])
			->all();
			
			
			if($images){
				foreach($images as $image  ){
					
					$this->arrElementsImageDetail[$image['elementid']]=$image['filed'];
					$this->arrElementsImage[$image['elementid']]=$image['filep'];
					
					
				}
				
				
				
				
			}
			
			
			
			
			foreach($this->arrElements  as $key => $element){
				
				
				if( isset(  $this->arrElementsImage[$element['id']])   ){  // $element['image']=
					
					$this->arrElements[$key]['image']=$this->arrElementsImage[$element['id']];
					
					$this->arrElements[$key]['imaged']=$this->arrElementsImageDetail[$element['id']];
					
					
					//  echo $element['image'];
					
				}else{ //echo 'not';
					$this->arrElements[$key]['image']='not';
					$this->arrElements[$key]['imaged']='not';
					
				}
				
				
				
			}
			
			
			
			
			
		}
		
		

	}
	
	
	
	public function fillPriceForElementArray(){
		
		$this->arrElementsPrice=[];
		
		$elementid=[];
		
		foreach($this->arrElements as $element){
			$elementid[]=$element['id'];
			
		}
		
		
		
		if( count($elementid)>0 ){
			
			
			
			
			
			
			$prices=Price::find()
			->where(['elementid'=>$elementid])
			->all();
			
			
			if($prices){

				// print_r($elementid);
				
				foreach($prices as $price  ){
					
					$this->arrElementsPrice[$price['elementid']]=$price['price'];
					
					
				}
				
				
				
				
			}
			
			
			
			
			foreach($this->arrElements  as $key => $element){
				
				
				if( isset(  $this->arrElementsPrice[$element['id']])   ){  // $element['image']=
					
					$this->arrElements[$key]['price']=$this->arrElementsPrice[$element['id']];
					
					
					//  echo $element['image'];
					
				}else{ //echo 'not';
					$this->arrElements[$key]['price']='not';
					
					
				}
				
				
				
			}
			
			
			
			
			
		}
		
		

	}
	
	
	public function fillQuantityForElementArray(){
		
		
		//echo'alex';
		
		
		$this->arrElementsQuantity=[];
		
		$elementid=[];
		
		foreach($this->arrElements as $element){
			$elementid[]=$element['id'];
			
		}
		
		
		
		if( count($elementid)>0 ){
			
			
			
			
			
			
			$quantitys=Quantity::find()
			->where(['elementid'=>$elementid])
			->all();
			
			
			if($quantitys){

				// print_r($elementid);
				
				foreach($quantitys as $quantity  ){
					// echo 'alex';
					
					
					$this->arrElementsQuantity[$quantity['elementid']]=$quantity['quantity'];
					
					
				}
				
				
				
				
			}
			
			
			
			
			foreach($this->arrElements  as $key => $element){
				
				
				if( isset(  $this->arrElementsQuantity[$element['id']])   ){   
					
					$this->arrElements[$key]['quantity']=$this->arrElementsQuantity[$element['id']];
					
					
					
					
				}else{ //echo 'not';
					$this->arrElements[$key]['quantity']='not';
					
					
				}
				
				
				
			}
			
			
			
			
			
		}
		
		

	}

	 
}
