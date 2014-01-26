<?php

/**
 * This is the model class for table "customers".
 *
 * The followings are the available columns in table 'customers':
 * @property integer $Q_number
 * @property string $PIN
 * @property string $C_name
 * @property integer $C_seats
 * @property string $C_time
 * @property integer $C_active
 * @property string $R_name
 *
 * The followings are the available model relations:
 * @property Restaurant $rName
 */
class Customers extends CActiveRecord {

    public $drpMinute;  //use in the bootstrap form
    public $Q;
    public $status;
    public $available;
    public $callbox;
    public $servbookbox;
    public $servnonbookbox;
    public $jdate;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'customers';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
// NOTE: you should only define rules for those attributes that
// will receive user inputs.
        return array(
            array('C_name', 'required', 'message' => 'กรุณาใส่ชื่อผู้รับบริการ'),
            array('C_seats', 'required', 'message' => 'กรุณาเลือกจำนวนผู้เข้ารับบริการ'),
            array('C_time, drpMinute, jdate', 'required', 'message' => 'กรุณาเลือกวันที่และเวลา'),
            array('Q_number, C_seats', 'numerical', 'integerOnly' => true),
            array('PIN', 'length', 'max' => 4),
            array('C_name, R_name', 'length', 'max' => 255),
            // The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
            array('Q_number, PIN, C_name, C_seats, C_time, C_active, C_call, C_service, R_name', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
// NOTE: you may need to adjust the relation name and the related
// class name for the relations automatically generated below.
        return array();
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'Q_number' => 'Q Number',
            'PIN' => 'PIN',
            'C_name' => 'ชื่อผู้รับบริการ',
            'C_seats' => 'จำนวนผู้เข้ารับบริการ',
            'C_time' => 'เวลา',
            'C_active' => 'C Active',
            'C_call' => 'C call',
            'C_service' => 'C service',
            'R_name' => 'R Name',
            'jdate' => 'วันที่'
        );
    }

    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search() {
// @todo Please modify the following code to remove attributes that should not be searched.

        $criteria = new CDbCriteria;

        $criteria->compare('Q_number', $this->Q_number);
        $criteria->compare('PIN', $this->PIN, true);
        $criteria->compare('C_name', $this->C_name, true);
        $criteria->compare('C_seats', $this->C_seats);
        $criteria->compare('C_time', $this->C_time, true);
        $criteria->compare('C_active', $this->C_active);
        $criteria->compare('R_name', $this->R_name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    public function book($C_name, $C_time, $C_seats, $PIN) {
        $connection = Yii::app()->db;
        $Q_number = Customers::getQ();
        $sql = 'INSERT INTO customers (Q_number, C_name, C_seats, C_time, PIN) VALUE ( ' . $Q_number . ', \'' . $C_name . '\', ' . $C_seats . ' , ' . $C_time . ', \'' . $PIN . '\')';
        $command = $connection->createCommand($sql);
        $command->execute();
    }

    public function getQ() {
        $connection = Yii::app()->db;
        $command = $connection->createCommand('SELECT MAX(Q_number) as Q FROM customers');
        $result = $command->queryRow();
        return $result['Q'] + 1;
    }

    public function checkPIN($PIN) {
        $connection = Yii::app()->db;
        $sql = 'SELECT PIN as pin FROM customers WHERE PIN = \'' . $PIN . '\'';
        $command = $connection->createCommand($sql);
        $result = $command->queryRow();
        if ($result == null) {
            return true;
        }
        return false;
    }

    //Check can the restaurant service
    public function isAvailable($d, $m, $y, $hr, $mins, $seats) {
        $r_model = new Restaurant();
        $service = $r_model->getTime("HOUR", "R_service") * 60 + $r_model->getTime("MINUTE", "R_service");
        $time = ($hr * 60) + $mins - $service + 1;
        $time = Customers::Str2Time($time);
        $endtime = ($hr * 60) + $mins + $service;
        $endtime = Customers::Str2Time($endtime);
        $connection = Yii::app()->db;
        $t1 = $y . $m . $d . $time;    // start time
        $t2 = $y . $m . $d . $endtime;   // end time
        $sql1 = 'SELECT COUNT(C_seats) as n FROM customers WHERE C_time >= ' . $t1 . ' AND C_time < ' . $t2 . ' AND C_seats = ' . $seats . ';';
        $sql2 = 'SELECT R_tables as t FROM r_details WHERE R_seats = ' . $seats . ';';
        $command1 = $connection->createCommand($sql1);
        $command2 = $connection->createCommand($sql2);
        $rs1 = $command1->queryRow();
        $rs2 = $command2->queryRow();
        if ($rs2['t'] <= $rs1['n']) {
            $this->addError('status', 'วันที่ ' . $d . ' / ' . $m . ' / ' . $y . 'เวลา ' . $hr . ':' . $mins . 'นาฬิกา โต๊ะสำหรับ ' . $seats . ' ท่าน ' . ' เต็ม');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    //Convert minutes to hour.minute
    public function Str2Time($munites) {
        $munites = ceil($munites);
        $string = array();
        $hours = floor($munites / 60);
        $mins = floor($munites - ($hours * 60));
        if ($hours > 0 && $hours < 10) {
            $string[] = '0' . $hours;
        } else {
            $string[] = $hours;
        }
        if ($mins > 0 && $mins < 10) {
            $string[] = '0' . $mins;
        } else {
            $string[] = $mins;
        }
        $string[] = '00';
        return trim(implode($string));
    }

    public function getBooker($atv, $serv) {
        $criteria = new CDbCriteria;
        $criteria->compare('C_active', $atv);
        $criteria->compare('C_service', $serv);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array('defaultOrder' => 'C_time ASC'),
            'pagination' => array('pageSize' => 10,
            ))
        );
    }

    //query non activated booker
    public function checkBooker($pin) {
        $connection = Yii::app()->db;
        $sql = 'SELECT * FROM customers WHERE PIN =' . $pin . ';';
        $command = $connection->createCommand($sql);
        return $command->queryRow();
    }

    public function setActive($PIN) {
        $connection = Yii::app()->db;
        $sql = 'UPDATE ' . Customers::model()->tableName() . ' SET C_active = 1 WHERE PIN = ' . $PIN . ';';
        $command = $connection->createCommand($sql);
        $command->execute();
    }

    public function getBookedSeat($d, $m, $y, $hr, $mins, $seats) {
        $r_model = new Restaurant();
        $service = $r_model->getTime("HOUR", "R_service") * 60 + $r_model->getTime("MINUTE", "R_service");
        $time = ($hr[0] * 60) + $mins - $service + 1;
        $time = Customers::Str2Time($time);
        $endtime = ($hr[0] * 60) + $mins + $service;
        $endtime = Customers::Str2Time($endtime);
        $connection = Yii::app()->db;
        $t1 = $y . $m . $d . $time;    // start time
        $t2 = $y . $m . $d . $endtime;   // end time
        $sql1 = 'SELECT COUNT(C_seats) as n FROM customers WHERE C_time >=' . $t1 . ' AND C_time < ' . $t2 . ' AND C_seats = ' . $seats . ';';
        $command1 = $connection->createCommand($sql1);
        $rs1 = $command1->queryRow();
        return $rs1['n'];
    }

    //query activated booker
    public function getpop($atv, $call, $serv) {
        $connection = Yii::app()->db;
        $sql = 'SELECT * FROM customers WHERE C_active = ' . $atv . ' AND C_call = ' . $call . ' AND C_service = ' . $serv . ' ;';
        $command = $connection->createCommand($sql);
        return $command->queryAll();
    }

    //set PIN is called and add show display
    public function setcall($pin) {
        $connection = Yii::app()->db;
        $sql = 'UPDATE ' . Customers::model()->tableName() . ' SET C_call = 1 WHERE PIN = ' . $pin . ';';
        $command = $connection->createCommand($sql);
        $command->execute();
        $sql = 'INSERT INTO callqueue (PIN) VALUE ( \'' . $pin . '\' );';
        $command = $connection->createCommand($sql);
        $command->execute();
    }

    //set that PIN is serviced and remove show display
    public function setserv($pin) {
        if ($pin != NULL) {
            $connection = Yii::app()->db;
            $sql = 'UPDATE ' . Customers::model()->tableName() . ' SET C_service = 1 WHERE PIN = ' . $pin . ';';
            $command = $connection->createCommand($sql);
            $command->execute();
            $sql = 'DELETE FROM callqueue WHERE PIN = \'' . $pin . '\' ;';
            $command = $connection->createCommand($sql);
            $command->execute();
        } else {
            
        }
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Customers the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
