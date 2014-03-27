<?php
/**
 * CBaeLogRoute class file.
 *
 */
require_once "BaeLog.class.php";
class CBaeLogRoute extends CLogRoute
{
	private $level=''; 
	private $message='';
    	private $category='';
	private $time='';

	/**
	 * Initializes the route.
	 * This method is invoked after the route is created by the route manager.
	 */
	public function init()
	{
		parent::init();
	}


	/**
	 * Saves log messages in files.
	 * @param array $logs list of log messages
	 */
	protected function processLogs($logs)
	{
		$logger=BaeLog::getInstance();
		
		foreach($logs as $log)
		{
		  $this ->message = $log[0];
		  $this ->level = $log[1];
		  $this ->category = $log[2];
		  $this ->time = $log[3];
		}
		/**
		 * const LEVEL_TRACE='trace';用于调试环境，追踪程序执行流程  
         * const LEVEL_WARNING='warning';警告信息  
         * const LEVEL_ERROR='error';致命错误信息  
         * const LEVEL_INFO='info';普通提示信息  
         * const LEVEL_PROFILE='profile';性能调试信息  
		*/
	       switch ($this ->level){
        	case "error":
            	 $logger ->logFatal($this ->level.' '.$this ->message.' category:'.$this ->category);
            	 break;
	        case "warning":
	             $logger ->logWarning($this ->level.' '.$this ->message.' category:'.$this ->category);
        	break;
       		case "info":
            	 $logger ->logNotice($this ->level.' '.$this ->message.' category:'.$this ->category);
            	 break;
       	        case "trace":
             	 $logger ->logTrace($this ->level.' '.$this ->message.' category:'.$this ->category);
                 break;
       	        case "profile":
                 $logger ->logDebug($this ->level.' '.$this ->message.' category:'.$this ->category);
                 break;
		default:$logger ->logWarning($this ->message);//替换error_log方法
		 break;
        }
	}
}
