<?php

namespace suPnPsu\material\components;

//use yii\base\Model;
use Yii;
use yii\helpers\Html;

/**
 * Description of navigate
 *
 * @author madone
 */
class Navigate extends \firdows\menu\models\Navigate {
    
    public function menu($category_id=null) {
        
        $model = Yii::createObject('\firdows\menu\models\Menu',[
            [
                'id'=>null,
                'title'=>'พัสดุทั้งหมด'
                ],
            [
                'id'=>null,
                'title'=>'พัสดุทั้งหมด'
                ],
            
        ]);
//        print_r($model);
//        exit();

        return $this->genArray($model);
    }
    

    public function getCount($router) {
        $count = '';
        switch ($router) {

            case '/repair/default/index':
                $searchModel = new \culturePnPsu\repair\models\DefaultIndexSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();

                $count = $count ? Html::tag('b', ' (' . $count . ')') : '';
                break;

            case '/repair/default/draft':
                $searchModel = new \culturePnPsu\repair\models\DefaultDraftSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? Html::tag('b', ' (' . $count . ')', ['class' => 'text-red']) : '';
                break;

            case '/repair/default/offer':
                $searchModel = new \culturePnPsu\repair\models\DefaultOfferSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? Html::tag('b', ' (' . $count . ')', ['class' => 'text-warning']) : '';
                break;

            case '/repair/default/done':
                $count = \backend\modules\repair\models\Repair::find()
                        ->where([
                            'created_by' => Yii::$app->user->id,
                            'status' => [6]
                        ])
                        ->count();
                $count = $count ? '<small class="label pull-right label-success">' . $count . '</small>' : '';
                break;

            ####################################
            /**
             * Staff
             */
            //case '/repair':
            case '/repair/staff/index':
                if (Yii::$app->user->can('staffMaterial')) {
                    $searchModel = new \culturePnPsu\repair\models\StaffIndexSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $count = $dataProvider->getTotalCount();
                    $count = $count ? '<small class="label pull-right bg-yellow">' . $count . '</small>' : '';
                }
                break;
                
            case '/repair/staff/consider':
                if (Yii::$app->user->can('staffMaterial')) {
                    $searchModel = new \culturePnPsu\repair\models\StaffConsiderSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $count = $dataProvider->getTotalCount();
                    $count = $count ? '<small class="label pull-right bg-blue">' . $count . '</small>' : '';
                }
                break;
                
            case '/repair/staff/repairing':
                if (Yii::$app->user->can('staffMaterial')) {
                    $searchModel = new \culturePnPsu\repair\models\StaffRepairingSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $count = $dataProvider->getTotalCount();
                    $count = $count ? '<small class="label pull-right bg-blue">' . $count . '</small>' : '';
                }
                break;
                
            case '/repair/staff/done':
                if (Yii::$app->user->can('staffMaterial')) {
                    $searchModel = new \culturePnPsu\repair\models\StaffDoneSearch();
                    $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                    $count = $dataProvider->getTotalCount();
                    $count = $count ? '<small class="label pull-right label-success">' . $count . '</small>' : '';
                }
                break;

            ####################

//            case '/repair/repairing':
//                $count = \backend\modules\repair\models\Repair::find()
//                        ->where([
//                            'status' => 5
//                        ])
//                        ->count();
//                $count = $count ? '<small class="label pull-right bg-blue">' . $count . '</small>' : '';
//                break;

            /**
             * ซ่อมคอม
             */            
            case '/repair/com/index':
                $searchModel = new \culturePnPsu\repair\models\ComIndexSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? '<b>(' . $count . ')</b>' : '';
                break;
            
            case '/repair/com/consider':
                $searchModel = new \culturePnPsu\repair\models\ComConsiderSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? '<small class="label pull-right ' . (Yii::$app->user->can('staffMaterial') ? 'bg-blue' : 'bg-yellow') . '">' . $count . '</small>' : '';
                break;

            case '/repair/com/repairing':
                $searchModel = new \culturePnPsu\repair\models\ComRepairingSearch;
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? '<small class="label pull-right bg-blue">' . $count . '</small>' : '';
                break;
            
            case '/repair/com/done':
                $searchModel = new \culturePnPsu\repair\models\ComDoneSearch();
                $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
                $count = $dataProvider->getTotalCount();
                $count = $count ? '<small class="label pull-right label-success">' . $count . '</small>' : '';
                break;

//            case '/repair/approve':
//                $count = \backend\modules\repair\models\Repair::find()
//                        ->andWhere(['status' => [2]])
//                        //->andWhere(['not', ['staff_status' => null]])
//                        //->andWhere(['not', ['boss_status' => null]])
//                        //->where(['not', ['staff_status' => null], 'not', ['boss_status' => null]])
//                        ->count();
//                //echo $count;
//                $count = $count ? '<small class="label pull-right ' . (Yii::$app->user->can('staffMaterial') ? 'bg-blue' : 'bg-yellow') . '">' . $count . '</small>' : '';
//                break;

//            case '/repair/done':
//                $count = \backend\modules\repair\models\Repair::find()
//                        ->where(['status' => 6])
//                        ->count();
//                $count = $count ? '<small class="label pull-right label-success">' . $count . '</small>' : '';
//                break;
        }
        $this->count = $count;
    }

}
