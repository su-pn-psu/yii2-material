<?php


use yii\helpers\Html;
use yii\grid\GridView;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//print_r($model);

if ($listDataProvider) {
    
    if($header){
    ?>

   
    <div class="row">
        <div class="col-sm-2 text-right">
            <label><?= $model->getAttributeLabel('id') ?></label>
        </div>
        <div class="col-sm-10">
            <?= $model->id ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2 text-right">
            <label><?= $model->getAttributeLabel('title') ?></label>
        </div>
        <div class="col-sm-10">
            <?= $model->title ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-2 text-right">
            <label><?= $model->getAttributeLabel('brand') ?></label>
        </div>
        <div class="col-sm-10">
            <?= $model->brand ?>
        </div>
    </div>
    <?php }
    echo Html::tag('h3','ประวัติการซ่อม');
    ?>
    <hr />
    <div class="row">
        <div class="col-sm-12">
            <?=
            GridView::widget([
                'dataProvider' => $listDataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],
                    'inform_at:datetime',
                    'problem:html',
                    [
                        'attribute' => 'created_by',
                        'value' => 'createdBy.displayname'
                    ],
                    'statusLabel:html'
                ]
            ]);
        }
        ?>
    </div>
</div>

