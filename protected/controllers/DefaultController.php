<?php

class DefaultController extends Controller {

	public function actionIndex() {
		$model = new Url();
		$this->render('index', [
			'model' => $model,
		]);
	}
}