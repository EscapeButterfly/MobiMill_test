<?php


namespace app\models;


use yii\db\ActiveRecord;

class StatisticsData extends ActiveRecord {

    /**
     * @return string
     */
    public static function tableName() {
        return '{{StatisticsData}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHybrid() {
        return $this->hasOne(Hybrids::class, ['id' => 'HybridId']);
    }
}