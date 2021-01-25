<?php
namespace backend\controllers;

use backend\models\Apple;
use backend\models\EntryForm;
use Yii;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;

/**
 * Site controller
 */
class SiteController extends Controller
{

    public $enableCsrfValidation = false;
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'create', 'drop', 'eat'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {


   //     $model = new EntryForm();
//
//        if($model->load(Yii::$app->request->post()) && $model->validate()) {
//            var_dump($model); die;
//        }

        $apples = Apple::find()
            ->all();
        return $this->render('index', compact('apples'));
    }

    public function actionCreate()
    {
        $colors = ['Green', 'Yellow', 'Orange', 'Red'];

        $number = rand(2, 5);
        for($i = 1; $i <= $number; $i++)
        {
            $rand_key = array_rand($colors, 1);
            $model = new Apple();
            $model->color = $colors[$rand_key];
            $model->save();
        }
     //   $model = new Apple();

//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        }

//        return $this->render('create', [
//            'model' => $model,
//        ]);
        \Yii::$app->session->setFlash('success', "Your have succesfully added $number apples");
     //   return $this->render('index');
        return $this->redirect(\Yii::$app->request->referrer);
    }


    public function actionDrop()
    {
        $id = \Yii::$app->request->get('id');
        $apple = Apple::findOne($id);
        if (empty($apple)){
            return false;
        }
        if($apple->status === 0) {
            $apple->status = 1;
            $apple->drop_time = date("Y-m-d H:i:s");
            $apple->save();
            \Yii::$app->session->setFlash('success', "The apple was successfully dropped!");
            return $this->redirect(\Yii::$app->request->referrer);
        } else {
            \Yii::$app->session->setFlash('error', "The apple is already on the ground!");
            return $this->redirect(\Yii::$app->request->referrer);
        }


    }


    public function actionEat()
    {
        $this->enableCsrfValidation = false;
        $id = \Yii::$app->request->get('id');
        $eat = \Yii::$app->request->get('eat');
      //  var_dump($eat); die;
        // getting apple
        $apple = Apple::findOne($id);
        if (empty($apple)){
            return false;
        }

//        if(isset($_POST['but'.$id])) {
//            $eat =  $_POST['eat'.$id];
//        } else {
//            $eat = 0;
//        }

        // getting eat from ajax
//        if (Yii::$app->request->isAjax){
//           // $eat = Yii::$app->request->get('eat'.$id);
//            $eat = $_GET['eat'.$id];
//         //  var_dump($eat); die;
//          //  return Json::encode($this->planing_model->curent_day);
//        } else {
//            // $eat = 25;
//           //$eat = Yii::$app->request->get('eat' . $id);
//            $eat = $_GET['eat'.$id];
//        }



        if($apple->status === 1) {

            // checking if apple is rotten - more than 5 hours
            if( ( strtotime(date("Y-m-d H:i:s")) - strtotime($apple->drop_time) ) > (60 *60 * 5) ) {
                \Yii::$app->session->setFlash('error', "You cannot eat this apple. It is already rotten");
                return $this->redirect(\Yii::$app->request->referrer);
            }

            // making calculations with eating
            if(($apple->size - $eat) <= 0) {
                $apple->delete();
                \Yii::$app->session->setFlash('error', "The apple was eaten");
                return $this->redirect(\Yii::$app->request->referrer);
            } else {
                $apple->size = $apple->size - $eat;
                $apple->save();
                \Yii::$app->session->setFlash('success', "You ate $eat % of apple");
                return $this->redirect(\Yii::$app->request->referrer);
            }

        }

        if($apple->status === 0){
            \Yii::$app->session->setFlash('error', "You cannot eat this apple. It is still on the tree");
            return $this->redirect(\Yii::$app->request->referrer);
        }



      //  $eat = Yii::$app->request->get('eat'.$id);
      //  $eat = Yii::$app->request->post([$_POST['eat'.$id]]);
    //    var_dump(Yii::$app->request->post('eat'.$id)); echo $id;
    //    var_dump($eat); die;

       // $model = new EntryForm();

//        if($model->load(Yii::$app->request->post()) && $model->validate()) {
//            var_dump($model); die;
//        }
    }



    /**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $this->layout = 'blank';

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            $model->password = '';

            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
}
