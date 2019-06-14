<?php

use yii\helpers\ArrayHelper;
use yii\widgets\ActiveForm;
use yii\helpers\Html;


$this->title = 'Пересечения гибридов:';

$form       = ActiveForm::begin();
$hybridList = ArrayHelper::map($hybrids, 'id', 'Name');
echo $form->field($hybridIds, 'firstHybridId')->label('Select hybrid')->dropDownList($hybridList);
echo $form->field($hybridIds, 'secondHybridId')->label('Select hybrid to find count of intersects')->dropDownList($hybridList);
echo Html::submitButton('Count', ['class' => 'btn btn-primary']);
ActiveForm::end();

if ($intersections) {
    echo '</br></br>';
    echo 'Count of intersections: ' . $intersections;
}