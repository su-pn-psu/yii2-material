<?php

use yii\bootstrap\Html;
//use yii\bootstrap\ActiveForm;
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use kartik\widgets\DatePicker;

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
    )->radioList($model->statlist, ['inline'=>true]) ?>

    <?= $form->field($model, 'available'
//        ,[
//            'horizontalCssClasses' => [
//                'label' =>'col-md-4',
//                'wrapper' => 'col-md-8',
//            ]
//        ]
    )->radioList($model->availlist, ['inline'=>true]) ?>

    <?php //= $form->field($model, 'file')->fileInput() ?>
    <?php
    echo $form->field($model, 'file',[
        'addon' => [
            'append' => !empty($model->image) ? [
                //'content'=> Html::a( Html::icon('download').' '.Yii::t('app', 'download'), Yii::getAlias('@webfrontend/uploads/inventory_files/'.$model->image), ['class' => 'btn btn-success', 'target' => '_blank']), 'asButton'=>true] : false
                'content'=> Html::a( Html::icon('download').' '.Yii::t('app', 'download'), Yii::getAlias('@web'.$model->image), ['class' => 'btn btn-success', 'target' => '_blank']), 'asButton'=>true] : false
        ]])->widget(FileInput::classname(), [
        //'options' => ['accept' => 'image/*'],
        'pluginOptions' => [
            'showPreview' => false,
            'showCaption' => true,
            'showRemove' => true,
            'initialCaption'=> $model->isNewRecord ? '' : $model->image,
            'showUpload' => false
        ]
    ]);
    ?>

    <?php /*= $form->field($model, 'bought_at')->widget(DatePicker::classname(), [
        'language' => 'th',
        'options' => ['placeholder' => Yii::t( 'app', 'enterdate')],
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);*/ ?>

    <?php /*= $form->field($model, 'warrant_at')->widget(DatePicker::classname(), [
        'language' => 'th',
        'options' => ['placeholder' => Yii::t( 'app', 'enterdate')],
        'type' => DatePicker::TYPE_COMPONENT_APPEND,
        'pluginOptions' => [
            'autoclose' => true,
            'format' => 'yyyy-mm-dd'
        ]
    ]);*/ ?>

    <?php //= $form->field($model, 'created_at')->textInput() ?>

    <?php //= $form->field($model, 'created_by')->textInput() ?>

    <?php //= $form->field($model, 'updated_at')->textInput() ?>

    <?php //= $form->field($model, 'updated_by')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
