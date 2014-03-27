<?php

/**
 * This is the model class for table "vote_user".
 *
 * The followings are the available columns in table 'vote_user':
 * @property integer $user_id
 * @property string $user_name
 * @property string $user_password
 * @property integer $left_ticket
 * @property string $name
 *
 * The followings are the available model relations:
 * @property Vote[] $votes
 */
class User extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return User the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'vote_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_name, user_password', 'required'),
			array('left_ticket', 'numerical', 'integerOnly'=>true),
			array('user_name', 'length', 'max'=>20),
			array('user_password', 'length', 'max'=>50),
			array('name', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('user_id, user_name, user_password, left_ticket,name', 'safe', 'on'=>'search'),
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
			'votes' => array(self::HAS_MANY, 'Vote', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'user_id' => '用户ID',
			'user_name' => '学号',
			'user_password' => '身份证',
			'left_ticket' => '剩余票数',
			'name' => '姓名',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_password',$this->user_password,true);
		$criteria->compare('left_ticket',$this->left_ticket);
		$criteria->compare('name',$this->name);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * 剩余票数减1
	 */
	public function decLeftTicket()
	{
		if($this->left_ticket > 0)
		{
			--$this->left_ticket;
			$this->save();
			return 1;
		}
		else
		{
			return 0;
		}
	}

	/**
	 * 检查用户是否已投某一项目
	 */
	public function checkVoted($project_id)
	{
		$sql="select * from vote_vote where user_id='".$this->user_id."' and project_id='".$project_id."'";
		if(Vote::model()->findBySql($sql) != null)
		{
			return 1;
		}
		else
		{
			return 0;
		}
	}

	/**
	 * 获得用户投的项目id
	 */
	public function getVoted()
	{
		$sql="select * from vote_vote where user_id='".$this->user_id."'";
		return Vote::model()->findAllBySql($sql);
	}
}