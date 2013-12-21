<?php

/**
 * This is the model class for table "restaurant".
 *
 * The followings are the available columns in table 'restaurant':
 * @property string $R_name
 * @property string $R_logo
 * @property string $R_open
 * @property string $R_close
 * @property string $R_service
 *
 * The followings are the available model relations:
 * @property Account[] $accounts
 * @property Customers[] $customers
 * @property RDetails[] $rDetails
 */
class Restaurant extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'restaurant';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('R_name, R_logo, R_open, R_close', 'required'),
			array('R_name, R_logo', 'length', 'max'=>255),
			array('R_service', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('R_name, R_logo, R_open, R_close, R_service', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'accounts' => array(self::HAS_MANY, 'Account', 'R_name'),
			'customers' => array(self::HAS_MANY, 'Customers', 'R_name'),
			'rDetails' => array(self::HAS_MANY, 'RDetails', 'R_name'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'R_name' => 'R Name',
			'R_logo' => 'R Logo',
			'R_open' => 'R Open',
			'R_close' => 'R Close',
			'R_service' => 'R Service',
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
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('R_name',$this->R_name,true);
		$criteria->compare('R_logo',$this->R_logo,true);
		$criteria->compare('R_open',$this->R_open,true);
		$criteria->compare('R_close',$this->R_close,true);
		$criteria->compare('R_service',$this->R_service,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

    //check that table not data
    public function checkDB()
    {
        $connection = Yii::app()->db;
        $command = $connection->createCommand('SELECT * FROM restaurant');
        $result = $command->queryRow();

        if($result == '0')
            return true;
        return false;
    }

    //$par1 => HOUR or MINUTE
    //$par2 => R_open or R_close
    public function getTime($par1,$par2){
        $connection = Yii::app()->db;
        $command = $connection->createCommand('SELECT '.$par1.' ('.$par2.') as time FROM restaurant');
        $result = $command->queryRow();
        return $result['time'];
    }

    //get restaurant name
    public function getName(){
        $connection = Yii::app()->db;
        $command = $connection->createCommand('SELECT R_name as name FROM restaurant');
        $result = $command->queryAll();
        return $result;
    }

	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
