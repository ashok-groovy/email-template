<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use dosamigos\tinymce\TinyMce;
use yii\web\JsExpression;


/* @var $this yii\web\View */
/* @var $model common\models\EmailTemplate */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="email-template-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'emai_template_name')->textInput(['maxlength' => true,'oninput'=>'myFunction()']) ?>

    <?= $form->field($model, 'email_subject')->textInput(['maxlength' => true,'oninput'=>'myFunction()']) ?>

    <?= $form->field($model, 'email_content')->widget(TinyMce::className(), [
            'options' => ['rows' => 12],
            'language' => 'en',
                
            'clientOptions' => [
                'force_br_newlines' => true,
                'force_p_newlines' => false,
                'forced_root_block' => '',
                'relative_urls' => false,
                'remove_script_host' => false,
                'convert_urls' => false,
                'images_dataimg_filter'=>  new JsExpression("function(img){
                    console.log(img);
                    return img.hasAttribute('internal-blob');
                }"),
            'plugins' => [
                "advlist autolink lists link charmap print preview anchor",
                "searchreplace visualblocks code fullscreen",
                "insertdatetime media table contextmenu paste image imagetools"
            ],
            "imagetools_toolbar"=>"editimage",
            
            // 'menubar'=> ["insert"],
            'automatic_uploads' => true,
            'file_picker_types'=> 'image',
            'image_caption'=>true,
            'images_upload_url'=> Url::base(true).'/email/default/uploadimage',
            
            
            'toolbar' => "undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | forecolor backcolor | link image imageupload | fontselect | cut copy paste"
        ]
        ]); ?>

    <?= $form->field($model, 'email_status')->dropDownList([ 'active' => 'Active', 'deactive' => 'Deactive', ], ['prompt' => '']) ?>


    <?= $form->field($model, 'email_slug')->hiddenInput()->label(false); ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<script> 
    function jsFunctionToBeCalled() {
        // ...
    }
</script>

