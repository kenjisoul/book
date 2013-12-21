<?php

class CustomersController extends Controller {

    public $layout = '//layouts/column3';

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

    /**
     * This is the default 'index' action that is invoked
     * when an action is not explicitly requested by users.
     */
    public function actionIndex() {
        $model = new Customers();
        if (isset($_POST['submit'])) {
            $model->attributes = $_POST['Customers'];
            $C_name = $model->C_name;
            $hr = $model->C_time;
            $mins = $model->drpMinute;
            $C_time = $hr . $mins . "00";
            $C_seats = $model->C_seats;
            if ($model->isAvailable($hr, $mins, $C_seats)) {
                $PIN = $this->generatePIN();
                $model = new Customers();
                $model->book($C_name, $C_time, $C_seats, $PIN);
                $this->redirect(array('view', 'name' => $C_name, 'time' => $hr . ':' . $mins . ' นาฬิกา', 'seat' => $C_seats, 'PIN' => $PIN));
            } else {
                $this->render('index', array('model' => $model, 'namefield' => $C_name));
            }
        } else {
            $this->render('index', array('model' => $model, 'namefield' => ''));
        }
    }

    public function actionAdmin() {
        $model = new Customers();
        $this->render('admin', array('model' => $model));
    }

    public function actionView($name, $time, $seat, $PIN) {
        $model = new Customers();
        $this->render('view', array('model' => $model, 'name' => $name, 'time' => $time, 'seat' => $seat, 'PIN' => $PIN));
    }

    public function actionCheck() {
        $model = new Customers();
        $r_model = new Restaurant();
        $par1 = 'HOUR';
        $par2 = 'R_open';
        $open = $r_model->getTime($par1, $par2);
        $par2 = 'R_close';
        $close = $r_model->getTime($par1, $par2);
        $this->render('check', array('model' => $model, 'hr_open' => $open, 'hr_close' => $close));
    }

    public function generatePIN() {
        $model = new Customers();
        $number = "1234567890";
        while (1) {
            $PIN = '';
            for ($i = 0; $i < 4; $i++) {
                $PIN .= $number[rand(0, strlen($number) - 1)];
            }
            if ($model->checkPIN($PIN))
                return $PIN;
        }
    }

    public function HH() {
        $r_model = new Restaurant();
        $par1 = 'HOUR';
        $par2 = 'R_open';
        $open = $r_model->getTime($par1, $par2);
        $par2 = 'R_close';
        $close = $r_model->getTime($par1, $par2);
        $par1 = 'MINUTE';
        $par2 = 'R_close';
        $m_close = $r_model->getTime($par1, $par2);
        if($m_close == 00)
            $close = $close - 1;
        $rs = array();
        for ($i = $open; $i <= $close; $i++) {
            $rs[$i] = $i;
        }
        return $rs;
    }

    public function actionMM() {
        if (isset($_POST['hour']) && $_POST['hour'] != '') {
            $hour = $_POST['hour'];
            $r_model = new Restaurant();
            $start = '00';
            $end = '60';
            if ($hour == $r_model->getTime('HOUR', 'R_open')) {
                $par1 = 'MINUTE';
                $par2 = 'R_open';
                $open = $r_model->getTime($par1, $par2);
                $start = $open + 1;
            } elseif ($hour == $r_model->getTime('HOUR', 'R_close')) {
                $par1 = 'MINUTE';
                $par2 = 'R_close';
                $close = $r_model->getTime($par1, $par2);
                $end = $close;
            }
            $rs = array();
            for ($i = $start; $i < $end; $i++) {
                if ($i < 10 && $i > 0)
                    $rs[$i] = '0' . $i;
                else
                    $rs[$i] = $i;
            }
            foreach ($rs as $id) {
                echo CHtml::tag('option', array('value' => $id), CHtml::encode($id), true);
            }
        }
    }

    public function queue() {
        $model = new Customers();
        $rs = $model->getQ();
        foreach ($rs as $value) {
            $data = $value;
        }
        return ($data + 1);
    }

    public function restaurant() {
        $r_model = new Restaurant();
        $rs = $r_model->getName();
        $data = array();
        foreach ($rs as $value) {
            $data[] = $value;
        }
        return $data;
    }

    public function getSeat() {
        $rdetail_model = new RDetails();
        $seats = $rdetail_model->getSeat();
        $rs = array();
        foreach ($seats as $value) {
            $rs[$value] = $value;
        }
        return $rs;
    }

    public function actionAll() {
        Yii::log('received', 'info', 'system.fucking.ajax.check');
        Yii::log(CVarDumper::dumpAsString($_POST), 'info', 'system.fucking.ajax.check');
        $rs = $_POST['minutes'];
        print_r($rs);
    }

    public function getAvailableSeats() {
        $name = $_POST['drpMinutes'];
        return $name;
    }

    public function getTime() {
        date_default_timezone_set("Asia/Bangkok");
        return date("H:i");
    }

}
