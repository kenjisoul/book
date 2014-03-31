<?php

class TestController extends Controller {

    public function filters() {
        return array(
            'accessControl', // perform access control for CRUD operations
        );
    }

    /**
     * Declares class-based actions.
     */
    public function accessRules() {
        return array(
            array('allow', // allow all users
                'actions' => array('*'),
                'users' => array('*'),
            ),
        );
    }

//index.php
    public function actionIndex() {
       $this->render('index');
    }
}
