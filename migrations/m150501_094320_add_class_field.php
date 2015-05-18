<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

use yii\db\Schema;
use yii\db\Migration;

class m150501_094320_add_class_field extends Migration
{
    
    public function safeUp()
    {
        $this->addColumn('{{%mata_form}}', 'Class', 'VARCHAR(255) NOT NULL');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%mata_form}}', 'Class');
    }

}
