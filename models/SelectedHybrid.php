<?php

namespace app\models;


use yii\base\Model;

class SelectedHybrid extends Model {
    public $firstHybridId;
    public $secondHybridId;

    public function rules() {
        return [
            ['firstHybridId', 'integer'],
            ['secondHybridId', 'integer']
        ];
    }
}