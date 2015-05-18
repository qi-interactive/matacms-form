<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

use yii\db\Schema;
use yii\db\Migration;

class m150422_131244_add_extra_field extends Migration
{
    
    public function safeUp()
    {
        $this->addColumn('{{%mata_form}}', 'Extra', 'TEXT');
    }

    public function safeDown()
    {
        $this->dropColumn('{{%mata_form}}', 'Extra');
    }

}
