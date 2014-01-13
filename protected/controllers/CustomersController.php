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
//index.php
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

//admin.php
    public function actionAdmin() {
        $model = new Customers();
        if (isset($_POST['submit'])) {
            $model->attributes = $_POST['Customers'];
            $PIN = $model->PIN;
            $model->setActive($PIN);
        }
        $this->render('admin', array('model' => $model));
    }

//view.php
    public function actionView($name, $time, $seat, $PIN) {
        $model = new Customers();
        $this->render('view', array('model' => $model, 'name' => $name, 'time' => $time, 'seat' => $seat, 'PIN' => $PIN));
    }

//chechk.php
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

//Generate PIN
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

//Get Restorant Open time - Close time (hour only)
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
        if ($m_close == 00)
            $close = $close - 1;
        $rs = array();
        for ($i = $open; $i <= $close; $i++) {
            $rs[$i] = $i;
        }
        return $rs;
    }

//Get Restorant Open time - Close time (minute only)
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

    //pop up body config
    public function actionBookdetails() {
        $PIN = $_POST['pin'];
        $rs = Customers::model()->checkBooker($PIN);
        $this->renderpartial('_activeform', array('rs' => $rs));
    }

    //Set queue number
    public function queue() {
        $model = new Customers();
        $rs = $model->getQ();
        foreach ($rs as $value) {
            $data = $value;
        }
        return ($data + 1);
    }

    //Get restaurant name use for if have many restaurant
    /*    public function restaurant() {
      $r_model = new Restaurant();
      $rs = $r_model->getName();
      $data = array();
      foreach ($rs as $value) {
      $data[] = $value;
      }
      return $data;
      }
     */

    //Get restaurant seat per table
    public function getSeat() {
        $rdetail_model = new RDetails();
        $seats = $rdetail_model->getSeat();
        $rs = array();
        foreach ($seats as $value) {
            $rs[$value] = $value;
        }
        return $rs;
    }

    //Check all available table
    public function actionAll() {
        $hr = $_POST['hour'];
        $min = $_POST['minutes'];
        $seat = RDetails::model()->getAll();
        ?>
        <table border="1" width="100%" style="text-align: center">
            <tr style="background-color: gainsboro">
                <td><b>จำนวนที่นั่ง (คน / โต๊ะ)</b></td>
                <td><b>ว่าง (โต๊ะ)</b></td>
            </tr>
            <?php
            foreach ($seat as $value) {
                $booked = Customers::model()->getBookedSeat($hr, $min, $value['R_seats'])
                ?>
                <tr>
                    <td width="50%"><?php print_r($value['R_seats']); ?></td>
                    <td width="50%"><?php print_r($value['R_tables'] - $booked); ?></td>
                </tr>
                <?php
            }
            ?>
            <tr>
                <td colspan="2"><?php print_r("เวลาที่เข้าใช้บริการ " . $hr[0] . " : " . $min . " นาฬิกา"); ?></td>
            </tr>
        </table>
        <?php
    }

    //Check is available to service status
    public function actionStatus() {
        $hr = $_POST['hour'];
        $min = $_POST['minutes'];
        $seat = $_POST['seats'];
        $model = new Customers();
        if ($hr == NULL || $min == NULL || $seat == NULL) {
            ?>
            <span class="required">
                <?php echo 'ข้อมูลไม่ครบถ้วน'; ?>
            </span>
            <?php
            echo '</br>';
            echo '</br>';
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Book',
                'buttonType' => 'submit',
                'htmlOptions' => array(
                    'name' => 'submit',
                ),
                'disabled' => true,
            ));
        } else if ($model->isAvailable($hr, $min, $seat)) {
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Book',
                'buttonType' => 'submit',
                'htmlOptions' => array(
                    'name' => 'submit',
                ),
            ));
        } else {
            ?>
            <span class="required">
                <?php echo 'เวลา ' . $hr . ':' . $min . 'นาฬิกา โต๊ะสำหรับ ' . $seat . ' ท่าน ' . ' เต็ม'; ?>
            </span>
            <?php
            echo '</br>';
            echo '</br>';
            $this->widget('bootstrap.widgets.TbButton', array(
                'label' => 'Book',
                'buttonType' => 'submit',
                'htmlOptions' => array(
                    'name' => 'submit',
                ),
                'disabled' => true,
            ));
        }
    }

    //Get current time
    public function getTime() {
        date_default_timezone_set("Asia/Bangkok");
        return date("H:i");
    }

}
