<?php

require_once Yii::app()->basePath . '/views/jobs/utils.php';
require_once Yii::app()->basePath . '/views/jobs/preprocess.php';

class JobsController extends GxController {

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Jobs'),
        ));
    }

    public function actionFilter() {
        if (!YII_DEBUG && !Yii::app()->request->isAjaxRequest) {
            throw new CHttpException('403', 'Forbidden access.');
        }
        $result = array();
        $url = $_POST["url"];
        $pos = strrpos($url, "?");
        $chartId = substr($url, $pos + 3);
//        echo $chartId;
        $chart = getChartInfo($chartId);
        $result["msg"] = "successful";
        $result["chart"] = $chart;
        $q = $chart["query"];

        if (isset($_POST["start_date"]) && strlen($_POST["start_date"]) > 0) {
            $q = Jobs::filter($q, "start_time", $_POST["start_date"], ">");
        }


        if (isset($_POST["end_date"]) && strlen($_POST["end_date"]) > 0) {
            $q = Jobs::filter($q, "end_time", $_POST["end_date"], "<");
        }

        if (isset($_POST["application"]) && strlen($_POST["application"]) > 0) {
            $q = Jobs::filter($q, "appname", $_POST["application"]);
        }

        $orderby = "start_time";
        if (isset($_POST["sort_level1"])) {
            $orderby = $_POST["sort_level1"];
        }

        $mode1 = "desc";
        if (isset($_POST["mode_level1"])) {
            $mode1 = $_POST["mode_level1"];
        }

        $q = Jobs::OrderBy($q, $orderby, $mode1);
        $q = Jobs::Limit($q, 5000);

        if (isset($_POST["sort_level2"])) {
            $sortlevel2 = $_POST["sort_level2"];
            $mode2 = "desc";
            if (isset($_POST["mode_level2"])) {
                $mode1 = $_POST["mode_level2"];
            }
            $q = Jobs::addSortingLevel($q, $sortlevel2, $mode2);
        }

        if (isset($_POST["sort_level3"])) {
            $sortlevel3 = $_POST["sort_level3"];
            $mode3 = "desc";
            if (isset($_POST["mode_level3"])) {
                $mode1 = $_POST["mode_level3"];
            }
            $q = Jobs::addSortingLevel($q, $sortlevel3, $mode3);
        }

        if (isset($_POST["user"]) && strlen($_POST["user"]) > 0) {
            $q = Jobs::filter($q, "uid", $_POST["user"]);
        }
//var_dump($q) ;
        $data = Jobs::execSQLQuery($q);

//print_r($data);
        $preprocess = $chart["preprocess"];
        $queryResult = $preprocess($chart, $data);
        $result["queryresult"] = $queryResult;
//        $result = array_merge($result, $result2);
//echo $series_str;
//        print_r($_GET);
//        if (empty($_GET['data'])) {
//            throw new CHttpException('404', 'Missing "data" GET parameter.');
//        }
//        $term = $_GET['term'];
//        $filters = empty($_GET['exclude']) ? null : (int) $_GET['exclude']);
//        echo json_encode(User::completeTerm($term, $exclude));

        header('Content-Type: application/json; charset="UTF-8"');
        echo json_encode($result);
        Yii::app()->end();
    }

    public function actionCreate() {
        $model = new Jobs;


        if (isset($_POST['Jobs'])) {
            $model->setAttributes($_POST['Jobs']);

            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'Jobs');


        if (isset($_POST['Jobs'])) {
            $model->setAttributes($_POST['Jobs']);

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Jobs')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Jobs');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionApplicationList($user, $application) {
        $criteria = new CDbCriteria;
        $criteria->select = 'appname';
        $criteria->distinct = true;
        if ($user != "null") {
            $criteria->addCondition('uid = ' . $user, 'AND');
        }
        if ($application != null && sizeof($application > 0)) {
            $criteria->addCondition('appname LIKE  :appname', 'AND');
        }
        $criteria->params = array(':appname' => "%$application%");
        $data = Jobs::model()->findAll($criteria);
        $just_apps = array();
        foreach ($data as $key => $value) {
            $just_apps[] = $value["appname"];
        }
        header('Content-Type: application/json; charset="UTF-8"');
        echo json_encode($just_apps);
        Yii::app()->end();
    }

    public function actionUserList($user, $application) {
        $criteria = new CDbCriteria;
        $criteria->select = 'uid';
        $criteria->distinct = true;
        if ($application != "null") {
            $criteria->addCondition('appname = ' . $application, 'AND');
        }
        if ($user != null && sizeof($user > 0)) {
            $criteria->addCondition('uid LIKE  :uid', 'AND');
        }
        $criteria->params = array(':uid' => "%$user%");
        $data = Jobs::model()->findAll($criteria);
        $just_users = array();
        foreach ($data as $key => $value) {
            $just_users[] = $value["uid"];
        }
        header('Content-Type: application/json; charset="UTF-8"');
        echo json_encode($just_users);
        Yii::app()->end();
    }

    public function actionAdmin() {
        $model = new Jobs('search');
        $model->unsetAttributes();

        if (isset($_GET['Jobs']))
            $model->setAttributes($_GET['Jobs']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

}
