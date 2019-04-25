<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs; 
/* @var $this yii\web\View */
/* @var $model common\models\EmailTemplate */
$this->title = Yii::t('app', 'Create Email Template');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Email Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="border-bottom-breadcumb pos-relative">
    <div class="prtm-block-title mrgn-b-lg">
        <div class="caption">
                <h3 class="text-capitalize"><?= $this->title;?></h3>
        </div>
        <div class="contextual-link">
            <?php 
            echo Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]);?>
        </div>
    </div>
</div>
<div class="email-template-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
