<?php

namespace komer45\balance\controllers;

use Yii;
use komer45\balance\models\Score;
use komer45\balance\models\SearchScore;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
//use common\models\User;
use yii\filters\AccessControl;
use yii\data\Sort;

/**
 * ScoreController implements the CRUD actions for Score model.
 */
class ScoreController extends Controller
{

	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => $this->module->adminRoles,
                    ],
                ]
            ],
        ];
    }
	
	

    /**
     * Lists all Score models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchScore();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		/**/
		$sort = new Sort([
			'attributes' => [
				'user_id' => [
					'default' => SORT_DESC,
					'label' => 'Пользователь',
				],
			],	
		]);
		/**/
		$userModel = Yii::$app->getModule('balance')->userModel;
		$users = $userModel::find()->asArray()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'sort' => $sort,
			'users' => $users
        ]);
    }

    /**
     * Displays a single Score model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
		$userModel = Yii::$app->getModule('balance')->userModel;
        return $this->render('view', [
            'model' => $this->findModel($id),
			'user' => $userModel::find()->asArray()->all()
        ]);
    }

    /**
     * Creates a new Score model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Score();
		
		$scores = Score::find()->asArray()->all();
		$userModel = Yii::$app->getModule('balance')->userModel;
		$users = $userModel::find()->all();
		
		$subQuery = Score::find()->select('user_id');
		$query = $userModel::find()->where(['not in', 'id', $subQuery]);
		$users = $query->all();

		if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
				'users' => $users
            ]);
        }
    }

    /**
     * Updates an existing Score model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
 /*   public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }
*/
    /**
     * Deletes an existing Score model.
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
     * Finds the Score model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Score the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Score::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionBalances()
	{
		$userModel = Yii::$app->getModule('balance')->userModel;
		$allUsers = $userModel::find()->all();
		//$balances = Score::find()->all();
		
		foreach ($allUsers as $user)
		{
			if(!(Score::find()->where(['user_id' => $user->id])->one()))
			{
				$userBalance = new Score;
				$userBalance->user_id = $user->id;
				$userBalance->balance = 0;
				
				if($userBalance->validate()){
					$userBalance->save();
				} else die('Uh-oh, somethings in ScoreController went wrong!');
			}
		}
		return $this->redirect(['index']);
	}

}
