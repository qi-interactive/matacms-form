<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\form\controllers;

use Yii;
use matacms\form\models\Form;
use matacms\form\models\FormSearch;
use matacms\controllers\module\Controller;
use matacms\base\MessageEvent;

/**
 * FormController implements the CRUD actions for Form model.
 */
class FormController extends Controller {

	public function getModel() {
		return new Form();
	}

	public function getSearchModel() {
		return new FormSearch();
	}

}
