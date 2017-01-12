<?php

namespace komer45\balance\controllers;

use Yii;
use komer45\balance\models\Transaction;
use komer45\balance\models\SearchTransaction;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
//use common\models\User;
use yii\helpers\ArrayHelper;
use komer45\balance\models\Score;
use yii\data\Sort;

/**
 * TransactionController implements the CRUD actions for Transaction model.
 */
class TransactionController extends Controller
{
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
						'actions' => ['index', 'transaction-invert', 'view', 'create', 'update', 'delete'],
                        'roles' => $this->module->adminRoles,
                    ],
					[
                        'allow' => true,
						'actions' => ['partner-index'],
                        'roles' => $this->module->otherRoles,
                    ],
                ]
            ],
        ];
    }

    /**
     * Lists all Transaction models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SearchTransaction();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		
		/**/
		$sort = new Sort([
			'attributes' => [
				'type' => [
					'default' => SORT_DESC,
					'label' => 'Тип транзакции',
				],
			],	
		]);
		
		$sort2 = new Sort([
			'attributes' => [
				'user_id' => [
					'default' => SORT_DESC,
					'label' => 'Пользователь',
				],
			],	
		]);
		
		$sort3 = new Sort([
			'attributes' => [
				'id' => [
					'default' => SORT_DESC,
					'label' => 'Id',
				],
			],	
		]);
		
		/**/
		$userModel = Yii::$app->getModule('balance')->userModel;
		$users = $userModel::find()->asArray()->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'typeSort' => $sort,
			'userSort' => $sort2,
			'idSort' => $sort3,
			'users' => $users,
        ]);
    }
	
	
	public function actionPartnerIndex($id)
    {
        $searchModel = new SearchTransaction();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->query->andWhere(['user_id' => $id]);
		$dataProvider->sort->defaultOrder = ['id' => SORT_DESC];	
		
		$sort = new Sort([
			'attributes' => [
				'type' => [
					'default' => SORT_DESC,
					'label' => 'Тип транзакции',
				],
			],	
		]);
		
		$sort2 = new Sort([
			'attributes' => [
				'user_id' => [
					'default' => SORT_DESC,
					'label' => 'Пользователь',
				],
			],	
		]);		
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
			'typeSort' => $sort,
			'userSort' => $sort2
        ]);
    }

    /**
     * Displays a single Transaction model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Transaction model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Transaction();

		$scores = Score::find()->all();

        if ($model->load(Yii::$app->request->post())) {
			$addTransaction = Yii::$app->balance->addTransaction($model->balance_id, $model->type, $model->amount, $model->refill_type);
			return $this->redirect(['view', 'id' => $addTransaction]);
        } else {
            return $this->render('create', [
                'model' => $model,
				'scores' => $scores
            ]);
        }
    }

    /**
     * Updates an existing Transaction model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    /*public function actionUpdate($id)
    {
        $model = $this->findModel($id);
		
		$typeBefore = $model->type;
		$amountBefore = $model->amount;
		
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            /*if ($typeBefore == $model->type){
				$model->balance = $model->balance - $amountBefore + $model->amount;
			}elseif ($typeBefore != $model->type){
				$model->balance = $model->balance - $amountBefore - $model->amount;
			}
			$model->save();*/
	/*		return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }*/

    /**
     * Deletes an existing Transaction model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
	 
    /*public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }*/

    /**
     * Finds the Transaction model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Transaction the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Transaction::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	
	public function actionTransactionInvert($id)
	{
		$newTransaction = new Transaction;
		
		$transaction = Transaction::findOne($id);
		$transaction->canceled = date('Y.m.d H:m:s');
		
		$scoreUpdate = Score::find()->where(['user_id' => $transaction->user_id])->one();

		$userScore = Score::find()->where(['user_id' => $transaction->user_id])->one();
		
		if ($transaction->type == 'in'){		//операция "приход"
			$newTransaction->type = 'out';
			$newTransaction->balance = $userScore->balance - $transaction->amount;
		}else {
			$newTransaction->type = 'in';
			$newTransaction->balance = $userScore->balance + $transaction->amount;
		}
		
		$scoreUpdate->balance = $newTransaction->balance;
		$newTransaction->balance_id = $transaction->balance_id;
		$newTransaction->date =	date("Y-m-d H:i:s");
		$newTransaction->amount = $transaction->amount;
		$newTransaction->user_id = $transaction->user_id;
		$newTransaction->refill_type = $transaction->refill_type;
		
		if($newTransaction->validate()){
			$newTransaction->save();
		} else {
			return die("Uh-ho, somethings in 'TransactionController' went wrong!");
		}
		$scoreUpdate->update();
		$transaction->update();
		return $this->redirect(['index']);
	}

}
