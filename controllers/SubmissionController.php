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
use yii\data\Sort;
use yii\web\NotFoundHttpException;

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

		if(!$formModel)
			throw new NotFoundHttpException('The requested page does not exist.');

		$formClass = $formModel->Class;
		$model = new $formClass;

		$dataProvider = $this->getFormSearchModel($model, \Yii::$app->request->queryParams);

		$sort = new Sort([
			'attributes' => $model->filterableAttributes()
		]);

		if(!empty($sort->orders)) {
			$dataProvider->query->orderBy = null;
		}

		$dataProvider->setSort($sort);

		return $this->render("index", [
			'dataProvider' => $dataProvider,
			'searchModel' => $model,
			'formModel' => $formModel,
			'sort' => $sort,
			'id' => $id
			]);
	}

	public function actionDetails($formId, $submissionId) {

		$formModel = \matacms\form\models\Form::findOne($formId);

		if(!$formModel)
			throw new NotFoundHttpException('The requested page does not exist.');

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
		$submission->delete();
		\Yii::$app->getSession()->addFlash('success', $formModel->Name ." <strong>".$submission->getLabel()."</strong> has been <strong>deleted</strong>.");

		return $this->redirect(['list?id=' . $formId]);
	}

	protected function getFormSearchModel($model, $params) {

        $query = $model->find();


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $model->load($params);

        if (!$model->validate()) {
            return $dataProvider;
        }

		foreach ($model->filterableAttributes() as $attribute) {
			$query->orFilterWhere(['like', $attribute, $model->$attribute]);
		}

        return $dataProvider;
	}

}
