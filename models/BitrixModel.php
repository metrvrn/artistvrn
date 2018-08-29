<?php
     
    namespace app\models;
     
use Yii;
use yii\base\Model;
     
    class BitrixModel extends  Model
    {  
        public	$message;
		public  $order;
		public  $basketArray;
		 
		public  $orderUserName;
		public  $orderUserId;
		
		
     
        public function rules()
        {
            return [
                ['message',],
                
            ];
        }
      
	  
	   public function findOne(){
		  
		  $this->orderUserName='custom';
		  $this->orderUserId='999999';
		  
		  
		  $orders=Order::find()
		  ->where(['status'=>1])
		  ->all();
		  
		  if($orders){
			  foreach($orders as $order){
				  
				  $this->order=$order;
				  
				  if(isset($order->userid)){
					  
					  $user=User::find()
					  ->where(['id'=>$order->userid])
					  ->one();
					  
					  if($user){
						  
						$this->orderUserName=$user->username;
						$this->orderUserId=$user->id;
						  
					  }
					  
					  
					  
				  }
				  
				  
				  
				  
				  break;
				  
			  }
			  
			  
		  }
		  
		  
		  
		  
	  }
	  
	  public function fillHeader(){
		  
		   $mes='<?xml version="1.0" encoding="windows-1251"?>
		        <КоммерческаяИнформация ВерсияСхемы="2.03" ДатаФормирования="'.substr($this->order->datatime,0,10).'">
					<Документ>
				<Ид>'.$this->order->id.'</Ид>
				<Номер>'.$this->order->id.'</Номер>
				<Дата>'.substr($this->order->datatime,0,10).'</Дата>
				<ХозОперация>Заказ товара</ХозОперация>
				<Роль>Продавец</Роль>
				<Валюта>RUB</Валюта>
				<Курс>1</Курс>
				<Сумма>'.$this->order->summ.'</Сумма>
				<Контрагенты>
					<Контрагент>
						<Ид>'.$this->orderUserId.'#'.$this->orderUserName.'#'.$this->order->name.'</Ид>
						<Наименование>'.$this->order->name.'</Наименование>
						<Роль>Покупатель</Роль>
								<ПолноеНаименование>Петр Петров</ПолноеНаименование>
								<Фамилия>'.$this->order->name.'</Фамилия><Имя>Петр</Имя>		
								<АдресРегистрации>
									<Представление>'.$this->order->adress.'</Представление>
								</АдресРегистрации>
									<Контакты>
									<Телефон>
									'.$this->order->phone.'
									</Телефон>
									<Email>
									'.$this->order->email.'
									</Email>
									</Контакты>
								<Представители>
								<Представитель>
									<Контрагент>
										<Отношение>Контактное лицо</Отношение>
										<Ид></Ид>
										<Наименование>'.$this->order->comment.' '.$this->order->phone.'  '.$this->order->email.'</Наименование>
									</Контрагент>
								</Представитель>
							</Представители>
													
					</Контрагент>
				</Контрагенты>
				
				<Время>'.substr($this->order->datatime,11,8).'</Время>
				<Комментарий>'.$this->order->comment.'</Комментарий>
				<Товары>';
				
				$this->message=$mes;
				
		   
		   
		   
		   
		  
	  }
	  
	  
	    public function fillBasket(){
			
			 
			$baskets=Basket::find()
			->where(['zakazid'=>$this->order->id])
			->all(); 
			
			if($baskets){	}else{return;}
				
			$elementIdArray=[];
			$elementDataArray=[];
			
			
			foreach($baskets as $basket){
				$elementIdArray[]=$basket->elementid;
								
			}
				
				
			$elements=Element::find()
			->where(['id'=>$elementIdArray])
			->all();
			
			if($elements){	}else{return;}
			
			foreach($elements as $element){
				  $intArray=[];
				  $intArray['id']=$element->id;
				  $intArray['name']=$element->name;
				  $intArray['xmlcode']=$element->xmlcode;
				  $elementDataArray[$element->id]= $intArray;
				
			}
				
				///delivery
				
				
			foreach($baskets as $basket){
				
				$this->message=	$this->message.'
				<Товар>
						<Ид>'.$elementDataArray[$basket->elementid]['xmlcode'].'</Ид>
						<ИдКаталога> </ИдКаталога>
						<Наименование>'.$elementDataArray[$basket->elementid]['name'].'</Наименование>
						<БазоваяЕдиница Код="796" НаименованиеПолное="Штука" МеждународноеСокращение="PCE">шт</БазоваяЕдиница>
												<ЦенаЗаЕдиницу>'.$basket->price.'</ЦенаЗаЕдиницу>
						<Количество>'.$basket->quantity.'</Количество>
						<Сумма>'.$basket->sum.'</Сумма>
												<ЗначенияРеквизитов>
							<ЗначениеРеквизита>
								<Наименование>ВидНоменклатуры</Наименование>
								<Значение>Товар</Значение>
							</ЗначениеРеквизита>
							<ЗначениеРеквизита>
								<Наименование>ТипНоменклатуры</Наименование>
								<Значение>Товар</Значение>
							</ЗначениеРеквизита>
						</ЗначенияРеквизитов>
					</Товар>				
				';
				
				
				
				
				
								
			}
				
				
				
				
			}
			
			
		  
		   
		  

	  
	     public function fillFooter(){
		  
		   $this->message=$this->message.'</Товары>
				<ЗначенияРеквизитов>
							<ЗначениеРеквизита>
							<Наименование>Дата оплаты</Наименование>
							<Значение>'.$this->order->datatime.'</Значение>
						</ЗначениеРеквизита>
							<ЗначениеРеквизита>
							<Наименование>Номер платежного документа</Наименование>
							<Значение>ТК00066</Значение>
						</ЗначениеРеквизита>
							<ЗначениеРеквизита>
							<Наименование>Метод оплаты</Наименование>
							<Значение>Наличный расчет</Значение>
						</ЗначениеРеквизита>
							<ЗначениеРеквизита>
							<Наименование>Дата разрешения доставки</Наименование>
							<Значение>'.$this->order->datatime.'</Значение>
						</ЗначениеРеквизита>
						<ЗначениеРеквизита>
						<Наименование>Заказ оплачен</Наименование>
						<Значение>true</Значение>
					</ЗначениеРеквизита>
					<ЗначениеРеквизита>
						<Наименование>Доставка разрешена</Наименование>
						<Значение>true</Значение>
					</ЗначениеРеквизита>
					<ЗначениеРеквизита>
						<Наименование>Отменен</Наименование>
						<Значение>false</Значение>
					</ЗначениеРеквизита>
					<ЗначениеРеквизита>
						<Наименование>Финальный статус</Наименование>
						<Значение>true</Значение>
					</ЗначениеРеквизита>
					<ЗначениеРеквизита>
						<Наименование>Статус заказа</Наименование>
						<Значение>[F] Доставлен</Значение>
					</ЗначениеРеквизита>
							<ЗначениеРеквизита>
							<Наименование>Дата изменения статуса</Наименование>
							<Значение>'.$this->order->datatime.'</Значение>
						</ЗначениеРеквизита>
					</ЗначенияРеквизитов>
			</Документ>
					</КоммерческаяИнформация>';
					
					
					$this->order->status=3;
					$this->order->save();
		  
	  }
	  
	  
	  
	  public function Bitrixgetxmlcode(){
		  
		  $this->message='Bitrixgetxmlcode';
		  
		  
		  
		  
		  
		  
		  
		  
	  }
     
    }
	
	?>