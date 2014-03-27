<?php

class VoteController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array(''),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('create'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(''),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Vote;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		$on=0;

		if($on == 0)
		{
			$json=array(
						'state'=>'error',
						'message'=>"投票已截止~<br/> <br/><a href='".$this->createUrl('site/result')."'><button class='btn btn-large btn-success btn-block'>查看投票结果</button></a>",
						);
			echo CJSON::encode($json);
			return;
		}

		//修改了请求方式 要改回来***************************************************************
		if(isset($_POST['project_id']) && Yii::app()->user->id)//是否登录
		{	
			$user_id=Yii::app()->user->id;
			$project_id=$_POST['project_id'];

			$user=User::model()->findByPk($user_id);
			if(!$user->checkVoted($project_id))//是否已投过该项目
			{
				if($user->decLeftTicket())//剩余票数是否充足
				{
					//刷票则跳转到错误页面
					if($this->judgeCheat($project_id))
					{
						$this->redirect($this->createUrl('site/error'));
						return;
					}

					//项目得票数加1
					$project=Project::model()->findByPk($project_id);
					$project->incProjectTicket();

					//插入投票记录
					$model->setAttributes(array(
										'project_id'=>$project_id,
										'user_id'=>$user_id,
										'vote_time'=>time(),
					));

					if(!$model->save())
					{
						Yii::log("插入投票记录失败！用户id：".Yii::app()->user->id." 项目id：".$project_id);
					}

					//返回成功信息
					$json=array(
							'state'=>'success',
							'message'=>'投票成功~'
							);
					echo CJSON::encode($json);
				}
				else
				{
					$json=array(
							'state'=>'error',
							'message'=>"剩余票数不足了！",
							);
					echo CJSON::encode($json);
				}
			}
			else
			{
				$json=array(
						'state'=>'error',
						'message'=>"您已投过该项目！",
						);
				echo CJSON::encode($json);
			}
		}
		else
		{
			$json=array(
					'state'=>'error',
					'message'=>"请登录后再投票！",
					);
			echo CJSON::encode($json);
		}
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Vote']))
		{
			$model->attributes=$_POST['Vote'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->vote_id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Vote');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Vote('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Vote']))
			$model->attributes=$_GET['Vote'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Vote the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Vote::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Vote $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='vote-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}

	/**
	 * 判断是否作弊
	 *
	 */
	public function judgeCheat($project_id)
	{
		$vote=Vote::model()->getRecent($project_id,2);

		if(count($vote) == 2)
		{
			$user1=$vote[0]->user->user_name;
			$user2=$vote[1]->user->user_name;
			$user3=User::model()->findByPk(Yii::app()->id)->user_name;

			$time1=strtotime($vote[1]->vote_time);
			$time3=time();
			$interval=$time3-$time1;

			if($interval <= 30)
			{
				similar_text($user3, $user2,$per1);
				if($per1 >= 80)
				{
					return 1;
				}
			}

			if($interval <= 60)
			{
				similar_text($user2, $user1,$per2);

				if($per1 >= 80 && $per2 >= 80 && $interval <= 60)
				{
					return 1;
				}
			}
		}

		return 0;
	}
}
