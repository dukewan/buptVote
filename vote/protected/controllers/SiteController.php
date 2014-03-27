<?php

class SiteController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/vote';

	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
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
				'actions'=>array('index','mobile','login','error','result'),
				'users'=>array('*'),
			),
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('chart','mobilevote','mobilesearch','logout'),
				'users'=>array('@'),
			),
			array('allow', // allow admin user to perform 'admin' and 'delete' actions
				'actions'=>array(),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/site/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$top10=Project::model()->getTop10();
		$projects=Project::model()->getAll();
		
		if(!Yii::app()->user->id)
		{
			$this->render('index',array(
										'top10'=>$top10,
										'projects'=>$projects,
						));
		}
		else
		{
			$user=User::model()->findByPk(Yii::app()->user->id);
			// var_dump($user->name);
			// throw new Exception($user->name, 1);
			

			$this->render('index',array(
										'top10'=>$top10,
										'projects'=>$projects,
										'user'=>$user,
						)); 
		}
	}

	/**
	 * 手机版登录页面
	 */
	public function actionMobile()
	{
		$this->renderPartial('mobile');
	}

	/**
	 * 手机版投票页面
	 */
	public function actionMobilevote()
	{
		$project=Project::model()->getRandom();
		if(!Yii::app()->user->id)
		{
			$this->renderPartial('mobile_vote',array('project'=>$project));
		}
		else
		{
			$user=User::model()->findByPk(Yii::app()->user->id);
			$this->renderPartial('mobile_vote',array('user'=>$user,'project'=>$project));
		}
	}

	/**
	 * 手机版搜索项目
	 */
	public function actionMobilesearch()
	{
		if(isset($_POST['project_no']))
		{
			$project_no=$_POST['project_no'];
			if($project_no == 0)
			{
				$json=array('result'=>Project::model()->getRandom());
			}
			else
			{
				$sql="select * from vote_project where project_no='".$project_no."'";
				$json=array('result'=>Project::model()->findAllBySql($sql));
			}
			echo CJSON::encode($json);
		}
	}


	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		// if($error=Yii::app()->errorHandler->error)
		// {
		// 	if(Yii::app()->request->isAjaxRequest)
		// 		echo $error['message'];
		// 	else
		// 		$this->renderPartial('error', $error);
		// }
		$this->renderPartial('error');
	}


	/**
	 * 投票结果页面
	 */
	public function actionResult()
	{
		$this->renderPartial('result');
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// collect user input data
		if(isset($_POST['username']) && isset($_POST['password']))
		{
			if(!isset($_POST['rememberMe']))
				$_POST['rememberMe']=0;

			$model->setAttributes(array(
				'username'=>$_POST['username'],
				'password'=>$_POST['password'],
				'rememberMe'=>$_POST['rememberMe'],
				));

			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
			{
				$user = User::model()->findByAttributes(array('user_name' => $model->username));
				$json=array(
					'state'=>'success',
					'message'=>"投票已截止~<br/> <br/><a href='".$this->createUrl('site/result')."'><button class='btn btn-large btn-success btn-block'>查看投票结果</button></a>",
					'name'=>$user->name,
					'left_ticket'=>$user->left_ticket,
					'logout_url'=>$this->createUrl('site/logout'),
					'voted'=>$user->getVoted(),
					'mobile_url'=>$this->createUrl('site/mobilevote')
					);
				echo CJSON::encode($json);
			}
			else
			{
				$json=array(
					'state'=>'error',
					'message'=>"学号或身份证号错误！",
					);
				echo CJSON::encode($json);
			}
		}
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout($type=1)
	{
		Yii::app()->user->logout();
		if($type == 1)
		{
			$this->redirect(Yii::app()->homeUrl);
		}
		else
		{
			$this->redirect($this->createUrl('site/mobile'));
		}
	}


	public function actionChart()
	{
		$this->renderPartial('chart');
	}
}