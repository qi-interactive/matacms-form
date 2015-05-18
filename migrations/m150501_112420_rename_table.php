<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

use yii\db\Schema;
use yii\db\Migration;

class m150501_112420_rename_table extends Migration
{
    
    public function safeUp()
    {
        $this->renameTable('{{%mata_form}}', '{{%matacms_form}}');
    }

    public function safeDown()
    {
        $this->renameTable('{{%matacms_form}}', '{{%mata_form}}');
    }

}
