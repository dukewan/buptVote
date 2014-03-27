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
		 * const LEVEL_TRACE='trace';���ڵ��Ի�����׷�ٳ���ִ������  
         * const LEVEL_WARNING='warning';������Ϣ  
         * const LEVEL_ERROR='error';����������Ϣ  
         * const LEVEL_INFO='info';��ͨ��ʾ��Ϣ  
         * const LEVEL_PROFILE='profile';���ܵ�����Ϣ  
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
		default:$logger ->logWarning($this ->message);//�滻error_log����
		 break;
        }
	}
}
