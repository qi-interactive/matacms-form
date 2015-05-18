<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\form;

use mata\base\Module as BaseModule;
use yii\helpers\Json;

class Module extends BaseModule {

	public $runBootstrap = true;

	/**
     * @var integer the permission to be set for newly generated code files.
     * This value will be used by PHP chmod function.
     * Defaults to 0666, meaning the file is read-writable by all users.
     */
	public $newFileMode = 0666;
    /**
     * @var integer the permission to be set for newly generated directories.
     * This value will be used by PHP chmod function.
     * Defaults to 0777, meaning the directory can be read, written and executed by all users.
     */
    public $newDirMode = 0777;

	public function getNavigation() {
		$forms = \matacms\form\models\Form::find()->all();
		$navigation = [];
		foreach ($forms as $form) {
			if(!empty($form->Extra)) {
				$settings = Json::decode($form->Extra);
				if(isset($settings['canShowInSubNavigation']) && !$settings['canShowInSubNavigation'])
					continue;
			}

			$navigation[] = [
				'label' => $form->getLabel(),
				'url' => "/mata-cms/form/submission/list?id=$form->Id",
				'icon' => "/images/module-icon.svg"
			];
		}
		
		return $navigation;

	}

}
