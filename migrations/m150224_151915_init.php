<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

use yii\db\Schema;
use yii\db\Migration;

class m150224_151915_init extends Migration {

	public function safeUp() {
		$this->createTable('{{%mata_form}}', [
			'Id' => Schema::TYPE_PK,
			'Name' => Schema::TYPE_STRING . '(128) NOT NULL',
			'ReferencedTable'  => Schema::TYPE_STRING . '(64) NOT NULL'
			]);
	}

	public function safeDown() {
		$this->dropTable('{{%mata_form}}');
	}

}
