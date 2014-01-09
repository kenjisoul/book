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
            array(' C_time, drpMinute', 'required', 'message' => 'กรุณาเลือกเวลา'),
            array('Q_number, C_seats', 'numerical', 'integerOnly' => true),
            array('PIN', 'length', 'max' => 4),
            array('C_name, R_name', 'length', 'max' => 255),
            // The following rule is used by search().
// @todo Please remove those attributes that should not be searched.
            array('Q_number, PIN, C_name, C_seats, C_time, C_active, R_name', 'safe', 'on' => 'search'),
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
            'C_time' => 'เวลาที่จะเข้าบริการ',
            'C_active' => 'C Active',
            'R_name' => 'R Name',
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

    public function isAvailable($hr, $mins, $seats) {
        $r_model = new Restaurant();
        $service = $r_model->getTime("HOUR", "R_service") * 60 + $r_model->getTime("MINUTE", "R_service");
        $time = ($hr * 60) + $mins - $service + 1 ;
        $time = Customers::Str2Time($time);
        $endtime = ($hr * 60) + $mins + $service;
        $endtime = Customers::Str2Time($endtime);
        $connection = Yii::app()->db;
        $sql1 = 'SELECT COUNT(C_seats) as n FROM customers WHERE C_time >=' . $time . ' AND C_time < ' . $endtime . ' AND C_seats = ' . $seats . ';';
        $sql2 = 'SELECT R_tables as t FROM r_details WHERE R_seats = ' . $seats . ';';
        $command1 = $connection->createCommand($sql1);
        $command2 = $connection->createCommand($sql2);
        $rs1 = $command1->queryRow();
        $rs2 = $command2->queryRow();
        if ($rs2['t'] <= $rs1['n']) {
            $this->addError('status', 'เวลา ' . $hr . ':' . $mins . 'นาฬิกา โต๊ะสำหรับ ' . $seats . ' ท่าน ' . ' เต็ม');
            return FALSE;
        } else {
            return TRUE;
        }
    }

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

    public function getBooker($bool) {
        $criteria = new CDbCriteria;
        $criteria->compare('C_active', $bool);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'sort' => array(
                'defaultOrder' => 'C_time ASC'
            ))
        );
    }

    public function setActive($PIN) {
        $criteria = new CDbCriteria;
        $criteria->compare('PIN', $PIN);

        return new CActiveDataProvider($this, array('criteria' => $criteria,));
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
