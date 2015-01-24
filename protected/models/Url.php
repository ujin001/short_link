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
			['original_url', 'validateUrl'],
		];
	}

	public function afterSave() {
		if(empty($this->hash) and !empty($this->id)) {
			$this->hash = Yii::app()->urlGenerator->generate($this->id);
			$this->save();
		}
		return true;
	}

	/**
	 * Проверка, что адрес существует
	 */
	public function validateUrl() {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->original_url);
		curl_setopt($ch, CURLOPT_HEADER, TRUE);
		curl_setopt($ch, CURLOPT_NOBODY, TRUE);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_exec($ch);
		$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		if($httpCode != 200) {
			$this->addError('original_url', 'Указан несуществующий адрес');
		};
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
}