<?php

class SiteController extends Controller {

    /**
     * Declares class-based actions.
     */
    public function actions() {
        return array(
            // captcha action renders the CAPTCHA image displayed on the contact page
            'captcha' => array(
                'class' => 'CCaptchaAction',
                'backColor' => 0xFFFFFF,
            ),
            // page action renders "static" pages stored under 'protected/views/site/pages'
            // They can be accessed via: index.php?r=site/page&view=FileName
            'page' => array(
                'class' => 'CViewAction',
            ),
        );
    }

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        // renders the view file 'protected/views/site/index.php'
        // using the default layout 'protected/views/layouts/main.php'
        $this->render('index');
    }

    /**
     * This is the action to handle external exceptions.
     */
    public function actionError() {
        if ($error = Yii::app()->errorHandler->error) {
            if (Yii::app()->request->isAjaxRequest)
                echo $error['message'];
            else
                $this->render('error', $error);
        }
    }

    /**
     * Displays the login page
     */
    public function actionLogin() {
        if (Yii::app()->user->getId() !== null) {
            $this->redirect(Yii::app()->user->returnUrl);
        }
        $model = new LoginForm;

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        // collect user input data
        if (isset($_POST['LoginForm'])) {
            $model->attributes = $_POST['LoginForm'];
            // validate user input and redirect to the previous page if valid
            if ($model->validate() && $model->login())
                $this->redirect(Yii::app()->user->returnUrl);
        }
        // display the login form
        $this->render('login', array('model' => $model));
    }

    /**
     * Logs out the current user and redirect to homepage.
     */
    public function actionLogout() {
        Yii::app()->user->logout();
        $this->redirect(Yii::app()->homeUrl);
    }

    public function getAll() {
        date_default_timezone_set("Asia/Bangkok");
        $d = date("d");
        $m = date("m");
        $y = date("Y");
        $hr = date("H");
        $min = date("i");
        ?>
        <table border = "1" width = "100%" style = "text-align: center" >
            <tr style = "background-color: gainsboro" >
                <td> <b> โซน </b></td>
                <td> <b> จำนวนที่นั่ง (คน / โต๊ะ) </b></td >
                <td> <b> ว่าง (โต๊ะ) </b></td >
            </tr>
            <?php
            $booked = Customers::model()->getAvailable($d, $m, $y, $hr, $min);
            foreach ($booked as $v1) {
                foreach ($v1 as $v2) {
                    if ($v2['R_tables'] != NULL) {
                        //$tmp = array[Z_id, R_seats,  ]
                        $tmp[$v2['Z_id']][$v2['R_seats']][0] = $v2['zone'];
                        $tmp[$v2['Z_id']][$v2['R_seats']][1] = $v2['R_seats'];
                        foreach ($v2['R_tables'] as $number) {
                            $tmp[$v2['Z_id']][$v2['R_seats']][$v2['Z_id'] . '-' . $number] = $number;
                        }
                    }
                }
            }
            foreach ($tmp as $value) {
                $count_loop = 0;
                foreach ($value as $tmp2) {
                    //$tmp2[0] is zone name
                    //$tmp2[1] is people seat per table
                    ?>
                    <tr >
                        <td width = "25%" >
                            <?php
                            if ($count_loop == 0) {
                                echo $tmp2[0];
                                $count_loop++;
                            }
                            ?>
                        </td>
                        <td width = "50%" >
                            <?php echo $tmp2[1]; ?> 
                        </td>
                        <td width = "25%" >
                            <?php
                            $tmp3 = array_reverse($tmp2);
                            array_pop($tmp3);
                            array_pop($tmp3);
                            $tmp2 = array_reverse($tmp3);
                            $count_table = 0;
                            foreach ($tmp2 as $tmp3) {
                                $count_table++;
                            }
                            echo $count_table;
                            $count_table = 0;
                            ?> 
                        </td>
                    </tr>
                    <?php
                }
                $count_loop = 0;
            }
            ?>
            <tr >
                <td colspan = "3" ><?php print_r("วันที่เข้าใช้บริการ <br/>" . $d . ' / ' . $m . ' / ' . $y . '<br/>เวลา ' . $hr . " : " . $min . " นาฬิกา"); ?> </td>
            </tr>
        </table>
        <?php
    }

    public function getCalls() {
        $booker = Customers::model()->getpop(1, 0, 0);
        return $booker;
    }

}
