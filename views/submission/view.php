<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Inflector;
use matacms\theme\simple\assets\ModuleIndexAsset;

/* @var $this yii\web\View */
/* @var $model mata\contentblock\models\ContentBlock */

$this->title = $formModel->Name . ' - ' . $model->getLabel();
$this->params['breadcrumbs'][] = ['label' => 'Content Blocks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="module-entry-detail-view">

    <div class="content-block-view">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $model,
            'template' => '<div class="item row"><div class="three columns item-label">{label}</div><div class="nine columns info">{value}</div></div>',
            'options' => [
            'tag' => 'div',
            'class' => 'details-view'
            ]
            ]) ?>

        </div>
    </div>

    <script>

        parent.mata.simpleTheme.header
        .setBackToListViewURL("<?= sprintf("/mata-cms/%s/%s/list?id=%s", $this->context->module->id, $this->context->id, $formModel->Id) ?>")
        .setText('PREVIEW <?= Inflector::camel2words($formModel->Name) ?> FORM SUBMISSION: <?= $model->getEventDate() ?>')
        .showBackToListView()
        .hideVersions()
        .show();

    </script>
