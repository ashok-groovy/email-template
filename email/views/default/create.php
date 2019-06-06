<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs; 
/* @var $this yii\web\View */
/* @var $model common\models\EmailTemplate */
$this->title = Yii::t('app', 'Create Email Template');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Email Templates'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<?php include_once($breadcrumb);?>
<div class="email-template-create">

    <?= $this->render('_form', [
        'model' => $model,
        'breadcrumb'=>$breadcrumb,
    ]) ?>

</div>
