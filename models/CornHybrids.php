<?php


namespace app\models;


use yii\db\ActiveRecord;

class CornHybrids extends ActiveRecord {

    /**
     * @return string
     */
    public static function tableName() {
        return '{{CornHybrids}}';
    }

    public function getHybrid() {
        return $this->hasOne(Hybrids::class, ['id' => 'HybridId']);
    }
}