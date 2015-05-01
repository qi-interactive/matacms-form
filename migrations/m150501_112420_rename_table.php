<?php

/*
 * This file is part of the mata project.
 *
 * (c) mata project <http://github.com/mata/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use yii\db\Schema;
use yii\db\Migration;

/**
 * @author Dmitry Erofeev <dmeroff@gmail.com>
 */
class m150501_112420_rename_table extends Migration
{
    
    public function up()
    {
        $this->renameTable('{{%mata_form}}', '{{%matacms_form}}');
    }

    public function down()
    {
        $this->renameTable('{{%matacms_form}}', '{{%mata_form}}');
    }

}
