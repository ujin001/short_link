<?php

class m150124_085139_create_table_url extends CDbMigration {

	public function up() {
		$this->createTable('tbl_urls', array(
			'id' => 'int AUTO_INCREMENT PRIMARY KEY',
			'hash' => 'varchar(10)',
			'original_url' => 'varchar(255)'
		));
	}

	public function down() {
		$this->dropTable('tbl_urls');
	}
}