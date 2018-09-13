<?php

namespace app\commands;

use yii\console\Controller;
use yii\console\ExitCode;
use app\models\SaleAdminModel;

class HelloController extends Controller
{
    public function actionIndex($message = 'hello world')
    {
        echo $message . "\n";

        return ExitCode::OK;
    }

    public function actionSendorder()
    {
	    $model=new SaleAdminModel();
		$model->sendOneOrderToSite();
		return $model->message;
    }
}
