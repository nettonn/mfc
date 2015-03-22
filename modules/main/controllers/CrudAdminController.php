<?php namespace app\modules\main\controllers;

use Yii;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use yii\web\NotFoundHttpException;
use app\modules\main\models\BaseActiveRecord;
use yii2mod\toggle\actions\ToggleAction;

abstract class CrudAdminController extends BaseAdminController
{
    /**
     * switch($typeOrCondition) {
     *     case 'search':
     *         return new UserSearch();
     *     case 'model':
     *         return new User();
     *     case 'name':
     *         return 'User';
     * }
     * return User::findOne($typeOrCondition);
     *
     * @param $typeOrCondition
     * @return mixed
     */
    abstract protected function getModel($typeOrCondition);

    public function behaviors()
    {
        return ArrayHelper::merge(parent::behaviors(), [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
        ]);
    }

    /**
     * Lists all models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = $this->getModel('search');
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        $this->editable($this->getModel('name'));

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = $this->getModel('model');

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(Yii::$app->request->post('save-add'))
                return $this->redirect(['create']);
            if(Yii::$app->request->post('save-exit'))
                return $this->redirect(['index']);
            if(Yii::$app->request->post('save-show') && method_exists($model, 'getUrl'))
                return $this->redirect($model->getUrl());
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            if(Yii::$app->request->post('save-add'))
                return $this->redirect(['create']);
            if(Yii::$app->request->post('save-exit'))
                return $this->redirect(['index']);
            if(Yii::$app->request->post('save-show') && method_exists($model, 'getUrl'))
                return $this->redirect($model->getUrl());
            return $this->redirect(['update', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return BaseActiveRecord the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = $this->getModel($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('Такой страницы не существует.');
        }
    }

    protected function editable($modelClass)
    {
        if (Yii::$app->request->post('hasEditable')) {
            $model = $this->findModel(Yii::$app->request->post('editableKey'));
            $post[$modelClass] = current($_POST[$modelClass]);
            if ($model->load($post))
                $model->save();
            echo Json::encode(['output'=>$this->getEditableReturnValue($post[$modelClass]), 'message'=>'']);
            Yii::$app->end();
        }
    }

    abstract protected function getEditableReturnValue($attributes);

    public function actions()
    {
        return [
            'toggle' => [
                'class' => ToggleAction::className(),
                'modelClass' => get_class($this->getModel('model')),
            ]
        ];
    }
}