<?php

namespace app\controllers;


use app\models\Hybrids;
use app\models\SelectedHybrid;
use app\models\StatisticsData;
use yii\web\Controller;

class IntersectionController extends Controller {
    /**
     * @return string
     */
    public function actionView() {
        $hybrids         = Hybrids::find()->all();
        $selectedHybrids = new SelectedHybrid();
        if ($selectedHybrids->load(\Yii::$app->request->post())) {
            $intersections = $this->getCountOfIntersectsBetweenHybrids($selectedHybrids->firstHybridId, $selectedHybrids->secondHybridId);
            return $this->render('index', [
                'hybrids'       => $hybrids,
                'hybridIds'     => new SelectedHybrid(),
                'intersections' => $intersections
            ]);
        }
        return $this->render('index', [
            'hybrids'       => $hybrids,
            'hybridIds'     => new SelectedHybrid(),
            'intersections' => null
        ]);
    }

    /**
     * @param $firstHybridId
     * @param $secondHybridId
     * @return int|string
     */
    protected function getCountOfIntersectsBetweenHybrids($firstHybridId, $secondHybridId) {
        $count = StatisticsData::find()
            ->innerJoin('StatisticsData as rel', 'rel.HybridId=:second', [':second' => $secondHybridId])
            ->where("StatisticsData.HybridId=:first", [':first' => $firstHybridId])
            ->andWhere('StatisticsData.Latitude=rel.Latitude')
            ->andWhere('StatisticsData.Longitude=rel.Longitude')
            ->count('rel.id');
        return $count;
    }
}