<?php

class DefaultController extends Controller {

	public function actionIndex() {
		$model = new Url();

		if(isset($_POST['ajax']) && $_POST['ajax']==='url-generation-form') {

			echo CActiveForm::validate($model);
			exit;
			Yii::app()->end();
		}
		$this->render('index', [
			'model' => $model,
		]);
	}
}