<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Resume */

$this->title = 'Создание нового резюме';

$this->params['breadcrumbs'][] = ['label' => 'Resumes', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="resume-create">


    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>

   