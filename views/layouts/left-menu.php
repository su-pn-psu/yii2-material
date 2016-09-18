<?php

use yii\helpers\Html;
use yii\helpers\BaseStringHelper;
//use firdows\menu\models\Navigate;
use suPnPsu\material\components\Navigate;
use mdm\admin\components\Helper;

/* @var $this \yii\web\View */
/* @var $content string */

$controller = $this->context;
//$menus = $controller->module->menus;
//$route = $controller->route;
$module = $this->context->module->id;
?>
<?php $this->beginContent('@app/views/layouts/main.php') ?>

<div class="row">
    <div class="col-md-3">

        <?= Html::a('<i class="fa fa-plus"></i> '.Yii::t('app', 'เพิ่มพัสดุ'), $this->context->module->createUrl, ['class' => 'btn btn-success btn-block margin-bottom']) ?>


        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">
                    <?=Yii::t('app','ระบบจัดการพัสดุ')?>
                </h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">

                <?php
                 $menuItems = [
                    [
                        'label' => 'พัสดุทั้งหมด',
                        'url' => ["/{$module}/default"], 
                        'icon' => 'fa fa-book'
                    ],
                    [
                        'label' => 'พัสดุที่ถูกยืม',
                        'url' => ["/{$module}/borrow"],
                        'icon' => 'fa fa-adn'
                    ],
                    [
                        'label' => 'พัสุดทีชำรุด',
                        'url' => ["/{$module}/damaged"],
                        'icon' => 'fa fa-key'
                    ],
                    ];
                
                $menuItems = Helper::filter($menuItems);
                $menuItems = Navigate::genCount($menuItems);               
                
                

                echo dmstr\widgets\Menu::widget([
                    'options' => ['class' => 'nav nav-pills nav-stacked'],
                    //'linkTemplate' =>'<a href="{url}">{icon} {label} {badge}</a>',
                    'items' => $menuItems,
                ]);
                ?>                 

            </div>
            <!-- /.box-body -->
        </div>
        <!-- /. box -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <?= $content ?>
        <!-- /. box -->
    </div>
    <!-- /.col -->
</div>


<?php $this->endContent(); ?>
