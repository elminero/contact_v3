<?php

namespace app\controllers;

use Faker\Provider\hy_AM\PhoneNumber;
use Yii;
use app\models\Person;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonController implements the CRUD actions for Person model.
 */
class PersonController extends Controller
{

    /*
        public function behaviors()
        {
            return [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => ['delete' => ['post'],
                    ],
              ],
            ];
        }

    */

    public function behaviors()
        {
            return [
                'access' => [
                    'class' => \yii\filters\AccessControl::className(),
                    'only' => ['list', 'profile'],
                    'rules' => [

                        [
                            'allow' => true,
                            'actions' => ['list'],
                            'roles' => ['@'],
                        ],

                        [
                            'allow' => true,
                            'actions' => ['profile'],
                            'roles' => ['@'],
                        ],

                    ],






                ],
            ];
        }





    /**
     * Lists all Person models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Person::find(),
        ]);

        return $this->render('index', ['dataProvider' => $dataProvider,]);
    }

    /**
     * Displays a single Person model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', ['model' => $this->findModel($id), ]);
    }


    /**
     * Displays a single Person model.
     * @param string $id
     * @return mixed
     */
    public function actionList()
    {
        $model = new Person();

      //  $model->getNamesWithAddress();

        return $this->render('list', ['namesWithAddress'=>$model->getNamesWithAddress()] );
    }




    public function actionSelect($id)
    {
        if( isset($_GET['remove']) ) {
            $pictureId = (int)$_GET['remove'];
            $model = new Person();
            $model->setPictureLiveToZero($pictureId);
        }

        return $this->render('viewPicturesSelect', ['model' => $this->findModel($id), ]);
    }




    public function actionPicture($id)
    {

        //       $model = new Person;



       return $this->render('picture/display', ['model' => $this->findModel($id), ]);
    }



    /**
     * Displays a single Profile model.
     * @param string $id
     * @return mixed
     */
    public function actionProfile($id)
    {
       $personModel = new Person();

        $avatar = $personModel->getAvatar($id);

       return $this->render('profile', ['model' => $this->findModel($id),  'avatar' => $avatar] );
    }


    /**
     * Creates a new Person model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Person();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['profile', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Person model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['profile', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }


    public function actionPortfolio($id)
    {


        return $this->render('portfolio', ['model' => $this->findModel($id), ]);


       /*
        $criteria = new CDbCriteria();
        $criteria->select = 'file_name, id';
        $criteria->condition = 'person_id=:person_id AND live=1' . ' ORDER BY id DESC';
        $criteria->params = array(':person_id'=>$id);
        $portfolio = picture::model()->findAll($criteria);

        $this->render('portfolio', array('model'=>$this->loadModel($id), 'portfolio'=>$portfolio ));

       */
    }



    /**
     * Deletes an existing Person model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Person model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return Person the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Person::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

/*
    protected function findPhoneNumber($personId)
    {
        if (($PhoneNumber = \app\models\PhoneNumber::findAll(1)) !== null) {
            return $PhoneNumber;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
*/
}
