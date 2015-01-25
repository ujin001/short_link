<?php

/**
 * This is the model class for table "tbl_urls".
 *
 * The followings are the available columns in table 'tbl_urls':
 * @property integer $id
 * @property string $hash
 * @property string $original_url
 */
class Url extends CActiveRecord {
	/**
	 * @return string the associated database table name
	 */
	public function tableName() {
		return 'tbl_urls';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules() {
		return [
			['hash', 'safe'],
			['original_url', 'required', 'message' => 'Необходимо указать адрес'],
			['original_url', 'url', 'allowEmpty' => false, 'message' => 'Вы указали некорректный адрес'],
		];
	}

	public function beforeValidate() {
		$protocol = '://';
		if(!strstr($this->original_url, $protocol)) {
			$this->original_url = 'http'.$protocol.trim($this->original_url);
		}
		return true;
	}

	public function afterSave() {
		if(empty($this->hash) and !empty($this->id)) {
			$this->setIsNewRecord(false);
			$this->hash = Yii::app()->urlGenerator->encode($this->id);
			$this->save();
		}
		return true;
	}

	/**
	 * @return array relational rules.
	 */
	public function relations() {
		return [];
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels() {
		return [
			'id' => 'ID',
			'hash' => 'Hash',
			'original_url' => 'Original Url',
		];
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Url the static model class
	 */
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	/**
	 * Возвращает абсолютный короткий урл
	 * @return string|null
	 **/
	public function getShortUrl() {
		if(empty($this->hash)) {
			return null;
		}

		return Yii::app()->createAbsoluteUrl('/'.$this->hash);
	}

	/**
	 * Возвращает урл по хешшу
	 * @return string|null
	 **/
	public function getOriginalUrlByHash($hash) {
		$id = Yii::app()->urlGenerator->decode($hash);

		$model = $this->findByPk($id);
		return !empty($model) ? $model->original_url : '';
	}

	/**
	 * Поиск хеша по оригинальному адресу
	 * @param $original_url
	 * @return array|bool|mixed|null
	 */
	public function findHashByOriginalUrl($original_url) {
		$model = $this->findByAttributes(array('original_url' => $original_url));

		return empty($model) ? false : $model->hash;
	}

	/**
	 * Проверяет, существует ли данный урл в базе, если нет - сохраняет
	 * @return bool
	**/
	public function saveUrl() {
		$this->hash = $this->findHashByOriginalUrl($this->original_url);

		if(!empty($this->hash)) {
			return true;
		}

		return $this->save();
	}
}