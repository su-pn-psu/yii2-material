<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
//use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;

/* @var $this yii\web\View */
/* @var $model suPnPsu\material\models\Material */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="material-form">

    <?php $form = ActiveForm::begin([
        //'type' => 'horizontal',
        'options' => ['enctype' => 'multipart/form-data']]); ?>

    <?= $form->field($model, 'id')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'brand')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status'
//        ,[
//            'horizontalCssClasses' => [
//                'label' =>'col-md-4',
//                'wrapper' => 'col-md-8',
//            ]
//        ]
    )->inline()->radioList($model->statlist) ?>

    <?= $form->field($model, 'available'
//        ,[
//            'horizontalCssClasses' => [
//                'label' =>'col-md-4',
//                'wrapper' => 'col-md-8',
//            ]
//        ]
    )->inline()->radioList($model->availlist) ?>
    <?php
//    echo $form->field($model, 'file',[
//        'addon' => [
//            'append' => !empty($model->invt_image) ? [
//                'content'=> Html::a( Html::icon('download').' '.Yii::t('kpi/app', 'download'), Yii::getAlias('@webfrontend/uploads/inventory_files/'.$model->invt_image), ['class' => 'btn btn-success', 'target' => '_blank']), 'asButton'=>true] : false
//        ]])->widget(FileInput::classname(), [
//        //'options' => ['accept' => 'image/*'],
//        'pluginOptions' => [
//            'showPreview' => false,
//            'showCaption' => true,
//            'showRemove' => true,
//            'initialCaption'=> $model->isNewRecord ? '' : $model->invt_image,
//            'showUpload' => false
//        ]
//    ]);
    ?>

    <?= $form->field($model, 'file')->fileInput() ?>

    <?= $form->field($model, 'bought_at')->textInput() ?>

    <?= $form->field($model, 'warrant_at')->textInput() ?>

    <?php //= $form->field($model, 'created_at')->textInput() ?>

    <?php //= $form->field($model, 'created_by')->textInput() ?>

    <?php //= $form->field($model, 'updated_at')->textInput() ?>

    <?php //= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
