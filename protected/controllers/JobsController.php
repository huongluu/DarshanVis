<?php

class JobsController extends GxController {


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Jobs'),
		));
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

		$this->render('create', array( 'model' => $model));
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