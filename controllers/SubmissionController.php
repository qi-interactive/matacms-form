<?php

/**
 * @link http://www.matacms.com/
 * @copyright Copyright (c) 2015 Qi Interactive Limited
 * @license http://www.matacms.com/license/
 */

namespace matacms\form\controllers;

use matacms\form\models\Form;
use matacms\form\models\FormSearch;
use matacms\controllers\module\Controller;
use yii\helpers\Json;
use yii\data\ActiveDataProvider;
use matacms\base\MessageEvent;

/**
 * FormController implements the CRUD actions for Form model.
 */
class SubmissionController extends Controller {

	public function getModel() {
		return new Form;
	}

	public function getSearchModel() {
		return new FormSearch;
	}

	public function actionList($id) {

		$formModel = \matacms\form\models\Form::findOne($id);

		$formClass = $formModel->Class;
		$model = new $formClass;

		$dataProvider = $this->getFormSearchModel($model, \Yii::$app->request->queryParams);

		return $this->render("index", [
			'dataProvider' => $dataProvider,
			'formModel' => $formModel
			]);
	}

	public function actionDetails($formId, $submissionId) {

		$formModel = \matacms\form\models\Form::findOne($formId);

		$formClass = $formModel->Class;
		$model = new $formClass;

		$submission = $model->findOne($submissionId);

		return $this->render("view", [
			'model' => $submission,
			'formModel' => $formModel
			]);
	}

	public function actionDeleteSubmission($formId, $submissionId) {

		$formModel = \matacms\form\models\Form::findOne($formId);

		$formClass = $formModel->Class;
		$model = new $formClass;

		$submission = $model->findOne($submissionId);

		$this->trigger(parent::EVENT_MODEL_DELETED, new MessageEvent($formModel->Name ." <strong>".$submission->getLabel()."</strong> has been <strong>deleted</strong>."));
		$submission->delete();

		return $this->redirect(['list?id=' . $formId]);
	}

	protected function getFormSearchModel($model, $params) {

        $query = $model->find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => false
        ]);

        $model->load($params);

        if (!$model->validate()) {
            return $dataProvider;
        }

        // TODO: in future add settings for search and filterable attributes
  		//  if(!empty($model->Extra)) {
		// 	$settings = Json::decode($model->Extra);
		// 	if(isset($settings['filterBy']) && !empty($settings['filterBy'])) {
		// 		foreach($settings['filterBy'] as $filterBy) {
		// 			// $query->andFilterWhere(['like', 'Name', $this->Name])
		// 			// var_dump($filterBy);
		// 		}
		// 	}
		// }

        return $dataProvider;
	}

}
