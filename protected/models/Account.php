<?php

/**
 * This is the model class for table "account".
 *
 * The followings are the available columns in table 'account':
 * @property string $A_user
 * @property string $A_pass
 * @property string $A_name
 * @property string $R_name
 *
 * The followings are the available model relations:
 * @property Restaurant $rName
 */
class Account extends CActiveRecord {

    public $A_pass_repeat;

    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'account';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('A_user, A_pass, A_name, R_name, A_pass_repeat', 'required'),
            array('A_user, A_pass, A_name, R_name', 'length', 'max' => 255),
            array('A_user', 'unique'),
            array('A_user', 'filter', 'filter' => 'strtolower'),
            array('A_pass', 'compare', 'message' => 'รหัสผ่านไม่ตรงกัน'),
            array('A_pass_repeat', 'safe'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('A_user, A_pass, A_name, R_name', 'safe', 'on' => 'search'),
        );
    }

    public function beforeSave() {
        $pass = MD5($this->A_pass);
        $this->A_pass = $pass;
        return true;
    }

    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'rName' => array(self::BELONGS_TO, 'Restaurant', 'R_name'),
        );
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'A_user' => 'Username',
            'A_pass' => 'Pass',
            'A_name' => 'Name',
            'R_name' => 'Restaurant',
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

        $criteria->compare('A_user', $this->A_user, true);
        $criteria->compare('A_name', $this->A_name, true);
        $criteria->compare('R_name', $this->R_name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return Account the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

}
