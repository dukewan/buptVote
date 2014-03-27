<?php

/**
 * This is the model class for table "vote_vote".
 *
 * The followings are the available columns in table 'vote_vote':
 * @property integer $vote_id
 * @property integer $project_id
 * @property integer $user_id
 * @property string $vote_time
 *
 * The followings are the available model relations:
 * @property Project $project
 * @property User $user
 */
class Vote extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Vote the static model class
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
		return 'vote_vote';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_id, user_id', 'required'),
			array('project_id, user_id', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('vote_id, project_id, user_id, vote_time', 'safe', 'on'=>'search'),
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
			'project' => array(self::BELONGS_TO, 'Project', 'project_id'),
			'user' => array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'vote_id' => 'Vote',
			'project_id' => 'Project',
			'user_id' => 'User',
			'vote_time' => 'Vote Time',
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

		$criteria->compare('vote_id',$this->vote_id);
		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('vote_time',$this->vote_time,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}



	/**
	 * 获取一个项目最近 num 个投票记录
	 */
	public function getRecent($project_id,$num)
	{
		if($project_id && $num)
		{
			$sql="select * from vote_vote where project_id = ".$project_id." order by vote_time desc limit ".$num;
			return Vote::model()->findAllBySql($sql);
		}
		else
		{
			return -1;
		}
	}
}