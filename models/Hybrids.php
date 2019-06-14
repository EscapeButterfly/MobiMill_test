<?php


namespace app\models;


use yii\db\ActiveRecord;

class Hybrids extends ActiveRecord {

    /**
     * @return string
     */
    public static function tableName() {
        return '{{Hybrids}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCulture() {
        return $this->hasOne(Cultures::class, ['id' => 'CulturesId']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCornHybrids() {
        return $this->hasMany(CornHybrids::class, ['HybridId' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStatistics() {
        return $this->hasMany(StatisticsData::class, ['HybridId' => 'id']);
    }
}