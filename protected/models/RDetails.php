<?php

/**
 * This is the model class for table "r_details".
 *
 * The followings are the available columns in table 'r_details':
 * @property integer $details_id
 * @property integer $R_seats
 * @property string $R_tables
 * @property string $R_name
 * @property integer $Z_id
 *
 * The followings are the available model relations:
 * @property RZone $z
 * @property RZone $rName
 */
class RDetails extends CActiveRecord {

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'r_details';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('R_seats, R_tables, R_name, Z_id', 'required'),
            array('R_seats, Z_id', 'numerical', 'integerOnly' => true),
            array('R_tables, R_name', 'length', 'max' => 255),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('details_id, R_seats, R_tables, R_name, Z_id', 'safe', 'on' => 'search'),
        );
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'z' => array(self::BELONGS_TO, 'RZone', 'Z_id'),
            'rName' => array(self::BELONGS_TO, 'RZone', 'R_name'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'details_id' => 'Details',
            'R_seats' => 'จำนวนที่นั่ง/โต๊ะ',
            'R_tables' => 'หมายเลขโต๊ะ',
            'R_name' => 'ชื่อร้าน',
            'Z_id' => 'Zone',
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

        $criteria->compare('details_id', $this->details_id);
        $criteria->compare('R_seats', $this->R_seats);
        $criteria->compare('R_tables', $this->R_tables, true);
        $criteria->compare('R_name', $this->R_name, true);
        $criteria->compare('Z_id', $this->Z_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RDetails the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getSeat() {
        $connection = Yii::app()->db;
        $command = $connection->createCommand('SELECT R_seats FROM r_details');
        $result = $command->queryColumn();
        return $result;
    }

    public function getAll() {
        $connection = Yii::app()->db;
        $command = $connection->createCommand('SELECT * FROM r_details');
        $result = $command->queryAll();
        return $result;
    }

}
