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
        $r_zone = new RZone();
        $data = $r_zone->getName();
        if (isset($_POST['submit'])) {
            $model->attributes = $_POST['Customers'];
            $C_name = $model->C_name;
            $hr = $model->C_time;
            if ($hr < 10)
                $hr = '0' . $hr;
            $mins = $model->drpMinute;
            $jdate = $model->jdate;
            $d = substr($jdate, 0, 2);
            $m = substr($jdate, 5, 2);
            $y = substr($jdate, 10, 4);
            $C_time = $y . $m . $d . (string) $hr . $mins . "00";
            $C_seats = $model->C_seats;
            $seats_tmp = NULL;
            foreach ($C_seats as $value) {
                if ($value != NULL && $seats_tmp == NULL) {
                    $seats_tmp = $value;
                } else if ($value != NULL && $seats_tmp != NULL) {
                    $seats_tmp = $seats_tmp . ',' . $value;
                }
            }
            if ($model->isAvailable($d, $m, $y, $hr, $mins, $seats_tmp)) {
                $PIN = $this->generatePIN();
                $model = new Customers();
                $model->book($C_name, $C_time, $seats_tmp, $PIN);
                $this->redirect(array('view', 'name' => $C_name, 'jdate' => $d . ' / ' . $m . ' / ' . $y, 'time' => $hr . ':' . $mins . ' นาฬิกา', 'seat' => $seats_tmp, 'PIN' => $PIN));
            } else {
                $this->render('index', array('model' => $model, 'namefield' => $C_name, 'zone' => $data));
            }
        } else {
            $this->render('index', array('model' => $model, 'namefield' => '', 'zone' => $data));
        }
    }

//admin.php
    public function actionAdmin() {
        $model = new Customers();
        if (isset($_POST['submit_active'])) {
            $model->attributes = $_POST['Customers'];
            $PIN = $model->PIN;
            $model->setActive($PIN);
        } elseif (isset($_POST['submit'])) {
            $model->attributes = $_POST['Customers'];
            $C_name = $model->C_name;
            $hr = $model->C_time;
            if ($hr < 10)
                $hr = '0' . $hr;
            $mins = $model->drpMinute;
            $jdate = $model->jdate;
            $d = substr($jdate, 0, 2);
            $m = substr($jdate, 5, 2);
            $y = substr($jdate, 10, 4);
            $C_time = $y . $m . $d . (string) $hr . $mins . "00";
            $C_seats = $model->C_seats;
            $seats_tmp = NULL;
            foreach ($C_seats as $value) {
                if ($value != NULL && $seats_tmp == NULL) {
                    $seats_tmp = $value;
                } else if ($value != NULL && $seats_tmp != NULL) {
                    $seats_tmp = $seats_tmp . ',' . $value;
                }
            }
            if ($model->isAvailable($d, $m, $y, $hr, $mins, $seats_tmp)) {
                $PIN = $this->generatePIN();
                $model = new Customers();
                $model->book($C_name, $C_time, $seats_tmp, $PIN, 1, 1, 1);
                $this->render('_viewbookingnow', array('model' => $model, 'name' => $C_name, 'jdate' => $d . ' / ' . $m . ' / ' . $y, 'time' => $hr . ':' . $mins . ' นาฬิกา', 'seat' => $seats_tmp, 'PIN' => $PIN));
                //$this->redirect(array('_viewbookingnow', 'name' => $C_name, 'jdate' => $d . ' / ' . $m . ' / ' . $y, 'time' => $hr . ':' . $mins . ' นาฬิกา', 'seat' => $seats_tmp, 'PIN' => $PIN));
            }
        } else {
            $this->render('admin', array('model' => $model));
        }
    }

//view.php
    public function actionView($name, $jdate, $time, $seat, $PIN) {
        $model = new Customers();
        $this->render('view', array('model' => $model, 'name' => $name, 'jdate' => $jdate, 'time' => $time, 'seat' => $seat, 'PIN' => $PIN));
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
        $jdate = $_POST['jdate'];
        $d = substr($jdate, 0, 2);
        $m = substr($jdate, 5, 2);
        $y = substr($jdate, 10, 4);
        $seat = RDetails::model()->getAll();
        ?>
        <table border = "1" width = "100%" style = "text-align: center" >
            <tr style = "background-color: gainsboro" >
                <td> <b> โซน </b></td>
                <td> <b> จำนวนที่นั่ง (คน / โต๊ะ) </b></td >
                <td> <b> ว่าง (โต๊ะ) </b></td >
            </tr>
            <?php
            $booked = Customers::model()->getAvailable($d, $m, $y, $hr[0], $min);
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
                <td colspan = "3" ><?php print_r("วันที่เข้าใช้บริการ <br/>" . $d . ' / ' . $m . ' / ' . $y . '<br/>เวลา ' . $hr[0] . " : " . $min . " นาฬิกา"); ?> </td>
            </tr>
        </table>
        <?php
    }

//Count table of seat
    public function CountSeat($seat, $compared) {
        
    }

//Check is available to service status
    public function actionStatus() {
        $jdate = $_POST['jdate'];
        $d = substr($jdate, 0, 2);
        $m = substr($jdate, 5, 2);
        $y = substr($jdate, 10, 4);
        $hr = $_POST['hour'];
        $min = $_POST['minutes'];
        $model = new Customers();
        if ($hr == NULL || $min == NULL || $jdate == NULL) {
            ?>
            <span class = "required" >
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
        } else {
            //get available table
            $list = $model->getAvailable($d, $m, $y, $hr, $min);
            $check_table = 0;
            foreach ($list as $value) {
                foreach ($value as $zone_list) {
                    if ($zone_list['R_tables'] != NULL) {
                        $check_table++;
                        $tmp[$zone_list['Z_id']][$zone_list['R_seats']][0] = $zone_list['zone'];
                        $tmp[$zone_list['Z_id']][$zone_list['R_seats']][1] = $zone_list['R_seats'];
                        foreach ($zone_list['R_tables'] as $number) {
                            $tmp[$zone_list['Z_id']][$zone_list['R_seats']][$zone_list['Z_id'] . '-' . $number] = $number;
                        }
                    }
                }
            }

            if ($check_table != 0) {
                foreach ($tmp as $value) {
                    $count_loop = 0;
                    foreach ($value as $tmp2) {
                        //echo zone name
                        if ($count_loop == 0) {
                            echo '<font size=5><b>' . $tmp2[0] . '</b></font> (ดูตำแหน่งที่นั่งได้จากรูป)<br/>';
                        }
                        echo '<b>สำหรับ ' . $tmp2[1] . ' ท่าน / โต๊ะ</b>';
                        $tmp3 = array_reverse($tmp2);
                        array_pop($tmp3);
                        array_pop($tmp3);
                        $tmp2 = array_reverse($tmp3);
                        echo $this->Widget('bootstrap.widgets.TbActiveForm')->checkBoxListInlineRow($model, 'C_seats[]', $tmp2, array('labelOptions' => array('label' => false)));
                        $count_loop++;
                        echo '<br/>';
                    }
                    $count_loop = 0;
                    echo '<br/>';
                }
                $this->widget('bootstrap.widgets.TbButton', array(
                    'label' => 'Book',
                    'buttonType' => 'submit',
                    'htmlOptions' => array(
                        'name' => 'submit',
                    ))
                );
            } else {
                ?>
                < span class = "required" >
                <?php echo 'ขออภัย ขณะนี้โต๊ะเต็มหมดแล้วครับ' ?>
                < /span>
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
    }

//Call Page
    public function pop1() {
        $rs = Customers::model()->getpop(1, 0, 0);
        return $rs;
    }

//Active Call
    public function actionCall() {
        $model = new Customers();
        $data = $_POST['pin'];
        foreach ($data as $value) {
            $model->setcall($value['value']);
        }
    }

//Service Booking Page
    public function pop2() {
        $rs = Customers::model()->getpop(1, 1, 0);
        return $rs;
    }

//Active Call
    public function actionServBook() {
        $model = new Customers();
        $data = $_POST['pin'];
        foreach ($data as $value) {
            $model->setserv($value['value']);
        }
    }

//Get current time
    public function getTime() {
        date_default_timezone_set("Asia/Bangkok");
        return date("H:i");
    }

}
