<?php

class DefaultController extends Controller {

	public function actionIndex() {
		$this->setPageTitle('Укротитель ссылок');

		$model = new Url();

		if(isset($_POST['ajax']) && $_POST['ajax']==='url-generation-form') {

			$response = CActiveForm::validate($model);
			if(!CJSON::decode($response)) {
				$model->saveUrl();
				$response = CJSON::encode([
					'generated_url' => $model->getShortUrl(),
				]);
			}

			echo $response;
			Yii::app()->end();
		}
		$this->render('index', [
			'model' => $model,
		]);
	}

	public function actionRedirect($hash) {
		$url = Url::model()->getOriginalUrlByHash($hash);

		if(empty($url)) {
			throw new CHttpException(404, 'Указан несуществующий адрес');
		}
		$this->redirect($url);
	}
}