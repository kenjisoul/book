<?php

/**
 * This is the model class for table "r_zone".
 *
 * The followings are the available columns in table 'r_zone':
 * @property integer $Z_id
 * @property string $zone
 * @property string $zone_img
 * @property string $R_name
 *
 * The followings are the available model relations:
 * @property Restaurant $rName
 */
class RZone extends CActiveRecord {
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'r_zone';
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('zone, zone_img, R_name', 'required'),
            array('zone, zone_img, R_name', 'length', 'max' => 255),
            array('zone_img', 'file', 'types' => 'jpg, gif, png', 'allowEmpty' => true, 'on' => 'update'),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array('Z_id, zone, zone_img, R_name', 'safe', 'on' => 'search'),
        );
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
            'Z_id' => 'id',
            'zone' => 'Zone',
            'zone_img' => 'แผนผังโซน',
            'R_name' => 'ร้าน',
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

        $criteria->compare('Z_id', $this->Z_id);
        $criteria->compare('zone', $this->zone, true);
        $criteria->compare('zone_img', $this->zone_img, true);
        $criteria->compare('R_name', $this->R_name, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return RZone the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function getName() {
        $connection = Yii::app()->db;
        $command = $connection->createCommand('SELECT * FROM r_zone');
        $result = $command->queryAll();
        return $result;
    }

    public function getNextID() {
        $connection = Yii::app()->db;
        $command = $connection->createCommand('SELECT MAX(Z_id) FROM r_zone');
        $result = $command->queryColumn();
        return $result[0] + 1;
    }

}
