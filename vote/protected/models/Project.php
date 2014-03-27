<?php

/**
 * This is the model class for table "vote_project".
 *
 * The followings are the available columns in table 'vote_project':
 * @property integer $project_id
 * @property string $project_no
 * @property string $project_school
 * @property string $project_name
 * @property integer $project_ticket
 *
 * The followings are the available model relations:
 * @property Vote[] $votes
 */
class Project extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Project the static model class
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
		return 'vote_project';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('project_no', 'required'),
			array('project_ticket', 'numerical', 'integerOnly'=>true),
			array('project_no,project_school', 'length', 'max'=>20),
			array('project_name', 'length', 'max'=>255),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('project_id, project_no, project_school, project_name, project_ticket', 'safe', 'on'=>'search'),
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
			'votes' => array(self::HAS_MANY, 'Vote', 'project_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'project_id' => 'Project',
			'project_no' => 'Project No',
			'project_school'=> 'Peoject School',
			'project_name' => 'Project Name',
			'project_ticket' => 'Project Ticket',
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

		$criteria->compare('project_id',$this->project_id);
		$criteria->compare('project_no',$this->project_no,true);
		$criteria->compare('project_school',$this->project_school,true);
		$criteria->compare('project_name',$this->project_name,true);
		$criteria->compare('project_ticket',$this->project_ticket);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}


	/**
	 *获得top10项目的数据
	 */
	public function getTop10()
	{
		$sql="select * from vote_project order by project_ticket desc limit 10";
		return Project::model()->findAllBySql($sql);
	}

	/**
	 *获得所有项目的数据
	 */
	public function getAll()
	{
		$sql="select * from vote_project order by project_id";
		return Project::model()->findAllBySql($sql);
	}

	/**
	 * 票数加1
	 */
	public function incProjectTicket()
	{
		++$this->project_ticket;
		$this->save();
	}

	/**
	 * 获取随机五个项目
	 */
	public function getRandom()
	{

		$sql="select * from vote_project order by rand() limit 5";
		return Project::model()->findAllBySql($sql);
	}


}