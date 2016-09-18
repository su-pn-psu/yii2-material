<?php

use yii\bootstrap\Html;
//use yii\grid\GridView;
use kartik\grid\GridView;
use suPnPsu\material\models\Material;
/* @var $this yii\web\View */
/* @var $searchModel suPnPsu\material\models\MaterialSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Materials');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class='box box-info'>

    <div class="booking-index">

        <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

        <?= GridView::widget([
            //'id' => 'kv-grid-demo',
            'dataProvider'=> $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                //['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'id',
                    'headerOptions' => [
                        'width' => '50px',
                    ],
                ],
                [
                    'attribute' => 'title',
                    'headerOptions' => [
                        'width' => '100px',
                    ],
                ],
                'brand',               
                [
                    'attribute' => 'status',
                    'value' => 'statusLabel',
                    'filter'=> Material::getItemStatus(),
                    'format'=>'html'
                ],
                'bought_at',
                // 'warrant_at',
                // 'created_at',
                // 'created_by',
                // 'updated_at',
                // 'updated_by',
                [
                    'class' => 'yii\grid\ActionColumn',
                    /*'visibleButtons' => [
                        'view' => Yii::$app->user->id == 122,
                        'update' => Yii::$app->user->id == 19,
                        'delete' => function ($model, $key, $index) {
                                        return $model->status === 1 ? false : true;
                                    }
                        ],
                    'visible' => Yii::$app->user->id == 19,*/
                ],
            ],
            'pager' => [
                'firstPageLabel' => Yii::t( 'app', '1stPagi'),
                'lastPageLabel' => Yii::t( 'app', 'lastPagi'),
            ],
            'responsive'=>true,
            'hover'=>true,
            'toolbar'=> [
                ['content'=>
                    Html::a(Html::icon('plus'), ['create'], ['class'=>'btn btn-success', 'title'=>Yii::t('app', 'Add Book')]).' '.
                    Html::a(Html::icon('repeat'), ['grid-demo'], ['data-pjax'=>0, 'class'=>'btn btn-default', 'title'=>Yii::t('app', 'Reset Grid')])
                ],
                //'{export}',
                '{toggleData}',
            ],
            'panel'=>[
                'type'=>GridView::TYPE_INFO,
                'heading'=> Html::icon('user').' '.Html::encode($this->title),
            ],
        ]); ?>
    </div>
 </div><!--box box-info-->
