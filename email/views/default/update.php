<?php

use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $model common\models\EmailTemplate */

$this->title = 'Update Email Template: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Email Templates', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
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
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>


