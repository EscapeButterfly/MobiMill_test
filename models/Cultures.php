<?php


namespace app\models;


use yii\db\ActiveRecord;

class Cultures extends ActiveRecord {

    /**
     * @return string
     */
    public static function tableName() {
        return '{{Cultures}}';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getHybrids() {
        return $this->hasMany(Hybrids::class, ['CulturesId' => 'id']);
    }
}