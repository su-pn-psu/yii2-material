<?php

namespace suPnPsu\material\components;

//use yii\base\Model;
use Yii;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * Description of navigate
 *
 * @author madone
 */
class Navigate extends \firdows\menu\models\Navigate {       

    public function getCount($router) {
        $count = '';      
        $module = Url::base().'/'.Yii::$app->controller->module->id;       
       
        switch ($router) {            

            case "{$module}/default":   
                $searchModel = new \suPnPsu\material\models\MaterialSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();

                $count = $count ? Html::tag('b', ' (' . $count . ')') : '';
                break;
            
            case "{$module}/borrow":   
                $searchModel = new \suPnPsu\material\models\MaterialSearchBorrow();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();

                $count = $count ? Html::tag('span',  $count,['class'=>'label bg-yellow pull-right']) : '';
                break;
        }
        
        return $count;
    }

}
