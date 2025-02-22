<?php
namespace ddmtechdev\user\controllers;

use Yii;
use ddmtechdev\user\models\User;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

class AdminController extends Controller
{public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['admin'], // Only allow admin to access all actions
                        ],
                        [
                            'allow' => false, // Deny access to others
                        ],
                    ],
                ],
            ]
        );
    }
    
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find(),
            'pagination' => ['pageSize' => 10],
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider]);
    }

    public function actionCreate()
    {
        $model = new User();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'User created successfully.');
            return $this->redirect(['index']);
        }

        return $this->render('create', ['model' => $model]);
    }

    // public function actionUpdate($id)
    // {
    //     $model = User::findOne($id);
    //     $model->scenario = 'update';

    //     if (!$model) {
    //         throw new NotFoundHttpException("User not found.");
    //     }

    //     if ($model->load(Yii::$app->request->post()) && $model->save()) {
    //         Yii::$app->session->setFlash('success', 'User updated successfully.');
    //         return $this->redirect(['index']);
    //     }

    //     return $this->render('update', [
    //         'model' => $model,
    //     ]);
    // }

    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        Yii::$app->session->setFlash('success', 'User deleted.');
        return $this->redirect(['index']);
    }

    public function actionBlock($id)
    {
        $model = $this->findModel($id);
        $model->status = User::STATUS_BLOCKED;
        $model->save(false);

        Yii::$app->session->setFlash('warning', 'User blocked.');
        return $this->redirect(['index']);
    }

    public function actionUnblock($id)
    {
        $model = $this->findModel($id);
        $model->status = User::STATUS_ACTIVE;
        $model->save(false);

        Yii::$app->session->setFlash('success', 'User unblocked.');
        return $this->redirect(['index']);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('User not found.');
    }
}
