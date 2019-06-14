<?php

namespace app\controllers;


use app\models\CornHybrids;
use app\models\Cultures;
use app\models\Hybrids;
use yii\base\ErrorException;
use yii\rest\ActiveController;

class HybridsController extends ActiveController {

    public $modelClass = 'app\models\Hybrids';

    public function actions() {
        $actions                                 = parent::actions();
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];
        return $actions;
    }

    public function prepareDataProvider() {
        \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
        if (\Yii::$app->request->get('outputType') === 'xml') {
            \Yii::$app->response->format = \yii\web\Response::FORMAT_XML;
        }
        $culturesID = \Yii::$app->request->get('culturesID');
        if ($culturesID) {
            return $this->loadHybridsByCultureId($culturesID);
        }
        $FAOUnits = \Yii::$app->request->get('faoRange');
        if ($FAOUnits) {
            return $this->loadHybridsByFAOUnit($FAOUnits);
        }
        return Hybrids::find()->all();
    }

    /**
     * @param $id
     * @return array|mixed
     */
    private function loadHybridsByCultureId($id) {
        if (intval($id) < 0) {
            return ['error' => 'Not valid ID'];
        }
        try {
            $result = Cultures::findOne(['id' => $id])->hybrids;
        } catch (ErrorException $e) {
            $result = [];
        }
        return empty($result) ? ['data' => 'Data not found'] : $result;
    }

    /**
     * @param $fao
     * @return array
     */
    private function loadHybridsByFAOUnit($fao) {
        $FAOArray = explode(',', $fao);
        try {
            $cornHybrids = CornHybrids::find()->with('hybrid')->where(['between', 'FAOUnits', $FAOArray[0], $FAOArray[1]])->all();
            foreach ($cornHybrids as $cornHybrid) {
                $result[] = $cornHybrid->hybrid;
            }
        } catch (ErrorException $e) {
            $result = [];
        }
        return empty($result) ? ['data' => 'No matches'] : $result;
    }
}