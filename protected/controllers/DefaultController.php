<?php

class DefaultController extends Controller {

	public function actionIndex() {
		$model = new Url();

		if(isset($_POST['ajax']) && $_POST['ajax']==='url-generation-form') {

			$response = CActiveForm::validate($model);
			if(!CJSON::decode($response)) {
				$model->save();
				$response = CJSON::encode([
					'short_url' => $model->getShortUrl(),
				]);
			}

			echo $response;
			Yii::app()->end();
		}
		$this->render('index', [
			'model' => $model,
		]);
	}
}