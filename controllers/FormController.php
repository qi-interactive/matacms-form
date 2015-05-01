<?php

namespace matacms\form\controllers;

use Yii;
use matacms\form\models\Form;
use matacms\form\models\FormSearch;
use matacms\controllers\module\Controller;

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

	public function actionCreate() {
		$model = $this->getModel();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$this->trigger(self::EVENT_MODEL_CREATED, new MessageEvent($model));

			return $this->redirect(['index', reset($model->getTableSchema()->primaryKey) => $model->getPrimaryKey()]);
		} else {
			return $this->render("create", [
				'model' => $model,
				]);
		}
	}

	public function actionUpdate($id) {

		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
			$this->trigger(self::EVENT_MODEL_UPDATED, new MessageEvent($model));
			return $this->redirect(['index', reset($model->getTableSchema()->primaryKey) => $model->getPrimaryKey()]);
		} else {

			return $this->render("update", [
				'model' => $model,
				]);
		}
	}

}
