<?php

namespace app\controllers;

use app\models\Persons;
use app\models\PersonsSearch;
use app\models\Mahasiswa;
use app\models\MahasiswaSearch;
use app\models\Pegawai;
use app\models\PegawaiSearch;
use app\models\Dosen;
use app\models\DosenSearch;
use app\models\InfoRiwayat;
use app\models\JenisRiwayat;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PersonsController implements the CRUD actions for Persons model.
 */
class PersonsController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
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
            ]
        );
    }

    /**
     * Lists all Persons models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PersonsSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionReport($id_person){
        $role = $this->findRole($id_person);

        return $this->render('report', [
            'model' => $this->findModel($id_person),
            'role' => $role
        ]);
    }

    public function actionRolelist($role)
    {
        if($role==1){
            $searchModel = new DosenSearch();
            $page = 'dosen';
        }else if($role==2){
            $searchModel = new MahasiswaSearch();
            $page = 'mahasiswa';
        }else {
            $searchModel = new PegawaiSearch();
            $page = 'pegawai';
        }
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render($page, [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'role' => $role
        ]);
    }

    /**
     * Displays a single Persons model.
     * @param int $id_person Id Person
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id_person)
    {
        $role = $this->findRole($id_person);

        return $this->render('view', [
            'model' => $this->findModel($id_person),
            'role' => $role
        ]);
    }

    /**
     * Creates a new Persons model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Persons();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'id_person' => $model->id_person]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    public function actionCreatejenisriwayat()
    {
        
        $model = new JenisRiwayat();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['createjenisriwayat']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('addjenisriwayat', [
            'model' => $model
        ]);
    }

    public function actionCreateriwayat($id_person, $role)
    {
        $model = new InfoRiwayat();
        $model_jenis = new JenisRiwayat();

        
        if ($this->request->isPost) {
            // echo "post";

            // die();
            if ($model->load($this->request->post())) {
                if($model->save()){
                    return $this->redirect(['view', 'id_person' => $model->id_person]);
                }else{
                    var_dump($model->errors);
                    die();
                }
            }else{
                var_dump($model->errors);
                die();
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('addriwayat', [
            'model' => $model,
            'model_jenis' => $model_jenis->getJenisItems(),
            'id_person' => $id_person,
            'role' => $role
        ]);
    }

    /**
     * Updates an existing Persons model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id_person Id Person
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id_person)
    {
        $model = $this->findModel($id_person);
        $role = $this->findRole($id_person);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id_person' => $model->id_person]);
        }

        return $this->render('update', [
            'model' => $model,
            'role' => $role
        ]);
    }

    public function actionRole()
    {
        $role = $this->request->post('role');
        $id_person = $this->request->post('id_person');

        // if ($role == 1) {
        //     $roleModel = new Dosen();
        // } else if ($role == 2) {
        //     $roleModel = new Mahasiswa();
        // } else if ($role == 3) {
        //     $roleModel = new Pegawai();
        // }

        $roleModel = $this->findModel($id_person);
        // $roleModel->id_person = $id_person;
        $roleModel->role = $role;
        $roleModel->save();
        return $this->redirect(['view', 'id_person' => $id_person]);
        // return $this->renderAjax('role', ['model' => $model]);
    }

    /**
     * Deletes an existing Persons model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id_person Id Person
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id_person)
    {
        $this->findModel($id_person)->delete();

        return $this->redirect(['index']);
    }

    public function actionDelriwayat($id_riwayat)
    {
        $mod = InfoRiwayat::findOne(["id_riwayat" => $id_riwayat]);
        $id_person = $mod->id_person;
        $mod->delete();

        return $this->redirect(['view', 'id_person' => $id_person]);
    }

    public function actionDeljenis($id_jenis)
    {
        JenisRiwayat::findOne(["id_jenisriwayat" => $id_jenis])->delete();

        return $this->redirect(['createjenisriwayat']);
    }

    public function actionMenikah($id_person)
    {
        $role = $this->findRole($id_person);

        if ($role==1 && ( $model = Dosen::findOne(['id_person' => $id_person])) !== null) {
            $model->tanggal_menikah = date("Y-m-d", strtotime('Now'));
            if($model->status_menikah==0){
                $model->status_menikah = 1;
            }else{
                $model->status_menikah = 0;
                $model->tanggal_menikah = null;
            }
            if($model->save()){
                return $this->redirect(['view', 'id_person' => $id_person]);
            }
        } else if ($role==2 &&( $model = Mahasiswa::findOne(['id_person' => $id_person])) !== null) {
            $model->tanggal_menikah = date("Y-m-d", strtotime('Now'));
            if($model->status_menikah==0){
                $model->status_menikah = 1;
            }else{
                $model->status_menikah = 0;
                $model->tanggal_menikah = null;
            }
            if($model->save()){
                return $this->redirect(['view', 'id_person' => $id_person]);
            }
        } else if ($role==3 &&( $model = Pegawai::findOne(['id_person' => $id_person])) !== null) {
            $model->tanggal_menikah = date("Y-m-d", strtotime('Now'));
            if($model->status_menikah==0){
                $model->status_menikah = 1;
            }else{
                $model->status_menikah = 0;
                $model->tanggal_menikah = null;
            }
            if($model->save()){
                return $this->redirect(['view', 'id_person' => $id_person]);
            }
        }else{
            return $this->redirect(['view', 'id_person' => $id_person]);
        }

    }

    /**
     * Finds the Persons model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id_person Id Person
     * @return Persons the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id_person)
    {

        // if(($model = Persons::find()->alias('a')->innerJoinWith('mahasiswa m', 'm.id_person = a.id_person')
        // ->all()) !== null){
        //     return $model;
        // }else if(($model = Persons::find()->alias('a')->innerJoinWith('pegawai m', 'm.id_person = a.id_person')
        // ->all()) !== null){
        //     return $model;
        // }else if(($model = Persons::find()->alias('a')->innerJoinWith('dosen m', 'm.id_person = a.id_person')
        // ->all()) !== null){
        //     return $model;
        // }

        if (($model = Persons::findOne(['id_person' => $id_person])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findRole($id_person)
    {
        return $this->findModel($id_person)->role;
        // if (($model = Dosen::findOne(['id_person' => $id_person])) !== null) {
        //     return 1;
        // } else if (($model = Mahasiswa::findOne(['id_person' => $id_person])) !== null) {
        //     return 2;
        // } else if (($model = Pegawai::findOne(['id_person' => $id_person])) !== null) {
        //     return 3;
        // } else {
        //     return 0;
        // }
    }
}
