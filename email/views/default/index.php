<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\widgets\Breadcrumbs;
/* @var $this yii\web\View */
/* @var $searchModel common\models\EmailTemplateSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = Yii::t('app', 'Email Templates');
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
    <?php Pjax::begin(); ?>
    <?php if($configure->allowInsert){?>
    <div class="clearfix">
        <div class="clearfix">
            <?= Html::a(Yii::t('app', '<i class="fa fa-plus"></i> Create Email Template'), ['create'], ['class' => 'btn btn-inverse pull-right btn-lg']) ?>
        </div>
    </div>
    <?php } ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            'emai_template_name',
            // 'email_status:email',
            'email_slug',

            ['class' => 'yii\grid\ActionColumn',
            'header' => 'Actions',
            'buttons'=>[
                    'view' => function ($url, $model) {
                        $configure = Yii::$app->get('emailtemplate', true);
                        $icons =  $configure->icons;
                        $text = Html::a('<i class="'.$icons['view'].'"></i>', $url, ['class'=>'success p-0']);
                        return  $text;
                    },
                    'update' => function ($url, $model) {
                        $configure = Yii::$app->get('emailtemplate', true);
                        $icons =  $configure->icons;
                        $text = Html::a('<i class="'.$icons['update'].'"></i>', $url, ['class'=>'success p-0']);
                        return  $text;
                    },
                    'delete' => function ($url, $model) {
                        $configure = Yii::$app->get('emailtemplate', true);
                        $icons =  $configure->icons;
                        if($configure->allowDelete){
                            return Html::a('<span class="'.$icons['delete'].'"></span>', ['delete', 'id' => $model->id], [
                                'class' => '',
                                'data' => [
                                    'confirm' => 'Are you absolutely sure ? You want to delete ?',
                                    'method' => 'post',
                                ],
                            ]);
                        }else{
                            return  false;
                        }
                        
                    },
                ],
                'template' => '{view}{update}{delete}',   
            ],

        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
