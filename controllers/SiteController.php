<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use phpDocumentor\Reflection\Types\Array_;
use app\models\Persons;
use app\models\Dosen;
use app\models\Mahasiswa;
use app\models\Pegawai;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
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
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
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
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionPersons(){
        $daftarPersons = Persons::find()->all();
        $data = array('title' => "Daftar Person", 'daftarPersons' => $daftarPersons);
        return $this->render('listPersons', $data);
    }

    public function actionPegawai(){
        $daftarPersons = Pegawai::find()
                        ->alias('a')
                        ->innerJoinWith('persons p','p.id_person = a.id_person')
                        ->all();
        $data = array('title' => "Daftar Person", 'daftarPersons' => $daftarPersons);
        return $this->render('listPersonsByRole', $data);
    }

    public function actionMahasiswa(){
        $daftarPersons = Mahasiswa::find()
                        ->innerJoinWith('persons', 'persons.id_person = mahasiswa.id_person')
                        ->all();
        $data = array('title' => "Daftar Person", 'daftarPersons' => $daftarPersons);
        return $this->render('listPersonsByRole', $data);
    }

    public function actionDosen(){
        $daftarPersons = Dosen::find()
                        ->alias('a')
                        ->innerJoinWith('persons p','p.id_person = a.id_person')
                        ->all();
        $data = array('title' => "Daftar Person", 'daftarPersons' => $daftarPersons);
        return $this->render('listPersonsByRole', $data);
    }

    public function actionInfodata($id){
        return $this->renderAjax('infoPerson');
    }

    public function actionAdd_data(){
        $model = new Persons();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {

            return $this->render('add-person-confirm', ['model' => $model]);
        } else {
            return $this->render('add-person', ['model' => $model]);
        }
    }
}
