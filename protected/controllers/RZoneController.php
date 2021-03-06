<?php

header('Content-Type: text/html; charset=utf-8');

class RZoneController extends Controller {

    /**
     * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
     * using two-column layout. See 'protected/views/layouts/column2.php'.
     */
    public $layout = '//layouts/column2';

    /**
     * @return array action filters
     */
    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Specifies the access control rules.
     * This method is used by the 'accessControl' filter.
     * @return array access control rules
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users to perform 'index' and 'view' actions
                'actions' => array('index', 'view'),
                'users' => array('*'),
            ),
            array('allow', // allow authenticated user to perform 'create' and 'update' actions
                'actions' => array('create', 'update'),
                'users' => array('@'),
            ),
            array('allow', // allow admin user to perform 'admin' and 'delete' actions
                'actions' => array('admin', 'delete'),
                'users' => array('admin'),
            ),
            array('deny', // deny all users
                'users' => array('*'),
            ),
        );
    }

    /**
     * Displays a particular model.
     * @param integer $id the ID of the model to be displayed
     */
    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id),
        ));
    }

    /**
     * Creates a new model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     */
    public function actionCreate() {
        $model = new RZone;

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        if (isset($_POST['RZone'])) {
            $model->attributes = $_POST['RZone'];
            $uploadedFile = CUploadedFile::getInstance($model, 'zone_img');
            $type = substr($uploadedFile, -4);
            $name = $model->getID() . $type;
            $fileName = "{$name}";
            $model->zone_img = $fileName;
            if ($model->save()) {
                $name = $model->getID() . $type;
                $fileName = "{$name}";
                $model->save($model->zone_img = $fileName);
                if (file_exists(Yii::app()->basePath . '/../zone image/' . $fileName)) {
                    unlink(Yii::app()->basePath . '/../zone image/' . $fileName);
                }
                $uploadedFile->saveAs(Yii::app()->basePath . '/../zone image/' . $fileName);
                //call resize function send filename
                $this->ImageResize($fileName);
                //$model->zone_img->save(Yii::app()->basePath.'/zone images/'.$fileName);
                $this->redirect(array('view', 'id' => $model->Z_id));
            }
        }

        $this->render('create', array(
            'model' => $model,
        ));
    }

    /**
     * Updates a particular model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id the ID of the model to be updated
     */
    public function actionUpdate($id) {
        $model = $this->loadModel($id);

        // Uncomment the following line if AJAX validation is needed
        // $this->performAjaxValidation($model);

        $uploadedFile = CUploadedFile::getInstance($model, 'zone_img');

        if (isset($_POST['RZone'])) {
            $model->attributes = $_POST['RZone'];
            if ($model->save())
                if (!empty($uploadedFile)) {  // check if uploaded file is set or not
                    $type = substr($uploadedFile, -4);
                    $name = $model->Z_id . $type;
                    $fileName = "{$name}";
                    $model->zone_img = $fileName;
                    if (file_exists(Yii::app()->basePath . '/../zone image/' . $fileName)) {
                        unlink(Yii::app()->basePath . '/../zone image/' . $fileName);
                    }
                    $model->save($model->zone_img = $fileName);
                    $uploadedFile->saveAs(Yii::app()->basePath . '/../zone image/' . $fileName);
                    //call resize function send filename
                    $this->ImageResize($fileName);
                }
            $this->redirect(array('view', 'id' => $model->Z_id));
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    /**
     * Deletes a particular model.
     * If deletion is successful, the browser will be redirected to the 'admin' page.
     * @param integer $id the ID of the model to be deleted
     */
    public function actionDelete($id) {
        if (Yii::app()->request->isPostRequest) {
            // we only allow deletion via POST request
            if (file_exists(Yii::app()->basePath . '/../zone image/' . $this->loadModel($id)->zone_img)) {
                unlink(Yii::app()->basePath . '/../zone image/' . $this->loadModel($id)->zone_img);
            }
            $this->loadModel($id)->delete();
            // if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
            if (!isset($_GET['ajax'])) {
                $this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
            }
        } else
            throw new CHttpException(400, 'Invalid request. Please do not repeat this request again.');
    }

    /**
     * Lists all models.
     */
    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('RZone');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    /**
     * Manages all models.
     */
    public function actionAdmin() {
        $model = new RZone('search');
        $model->unsetAttributes();  // clear any default values
        if (isset($_GET['RZone']))
            $model->attributes = $_GET['RZone'];

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    /**
     * Returns the data model based on the primary key given in the GET variable.
     * If the data model is not found, an HTTP exception will be raised.
     * @param integer the ID of the model to be loaded
     */
    public function loadModel($id) {
        $model = RZone::model()->findByPk($id);
        if ($model === null)
            throw new CHttpException(404, 'The requested page does not exist.');
        return $model;
    }

    /**
     * Performs the AJAX validation.
     * @param CModel the model to be validated
     */
    protected function performAjaxValidation($model) {
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'rzone-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
    }

    public function getRestaurant() {
        $r_model = new Restaurant();
        $data = $r_model->getName();
        $list = CHtml::listData($data, 'name', 'name');
        return $list;
    }

    public function ImageResize($img) {
        $images = Yii::app()->basePath . '/../zone image/' . $img;
        $size = GetimageSize($images);
        $new_images = Yii::app()->basePath . '/../zone image/tmp';
        $width = 400; //*** Fix Width & Heigh (Autu caculate) ***//
        $height = round($width * $size[1] / $size[0]);
        switch ($size['mime']) {
            case "image/gif":
                $new_images .= '.gif';
                $images_orig = imagecreatefromgif($images);
                $photoX = ImagesX($images_orig);
                $photoY = ImagesY($images_orig);
                $images_fin = ImageCreateTrueColor($width, $height);
                ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
                imagegif($images_fin, $new_images);
                rename($new_images, $images);
                break;
            case "image/jpeg":
                $new_images .= '.jpg';
                $images_orig = ImageCreateFromJPEG($images);
                $photoX = ImagesX($images_orig);
                $photoY = ImagesY($images_orig);
                $images_fin = ImageCreateTrueColor($width, $height);
                ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
                ImageJPEG($images_fin, $new_images);
                rename($new_images, $images);
                break;
            case "image/png":
                $new_images .= '.png';
                $images_orig = imagecreatefrompng($images);
                $photoX = ImagesX($images_orig);
                $photoY = ImagesY($images_orig);
                $images_fin = ImageCreateTrueColor($width, $height);
                ImageCopyResampled($images_fin, $images_orig, 0, 0, 0, 0, $width + 1, $height + 1, $photoX, $photoY);
                imagepng($images_fin, $new_images);
                rename($new_images, $images);
                break;
        }
        //free image from memory
        ImageDestroy($images_orig);
        ImageDestroy($images_fin);
    }

}
