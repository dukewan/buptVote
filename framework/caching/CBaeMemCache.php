<?php
/**
 * CBaeMemCache class file
 */
 

 require_once ('BaeMemcache.class.php');
class CBaeMemCache extends CCache
{

	/**
	 * @var Memcache the Memcache instance
	 */
	private $_cache=null;	
	/**
	 * Initializes this application component.
	 * This method is required by the {@link IApplicationComponent} interface.
	 * It creates the memcache instance.
	 * @throws CException if memcache extension is not loaded
	 */
	public function init()
	{
		parent::init();
		
		$this->getMemCache();
		
	}

	/**
	 * @return mixed the memcache instance (or memcached if {@link useMemcached} is true) used by this component.
	 */
	public function getMemCache()
	{
		if($this->_cache!==null)
			return $this->_cache;
		else
			return $this->_cache=new BaeMemcache;
	}

/**
	 * Stores a value identified by a key into cache if the cache does not contain this key.
	 * This is the implementation of the method declared in the parent class.
	 *
	 * @param string $key the key identifying the value to be cached
	 * @param string $value the value to be cached
	 * @param integer $expire the number of seconds in which the cached value will expire. 0 means never expire.
	 * @return boolean true if the value is successfully stored into cache, false otherwise
	 */
	protected function addValue($key,$value,$expire)
	{
		
//ensure the  $value is not null
	        if(empty($value))
		{
			Yii::log("the addValue param value is null", CLogger::LEVEL_WARNING);
		}
		else
		{
			return $this->_cache->add($key,$value,0,$expire);
		}
	}

	/**
	 * Retrieves a value from cache with a specified key.
	 * This is the implementation of the method declared in the parent class.
	 * @param string $key a unique key identifying the cached value
	 * @return string the value stored in cache, false if the value is not in the cache or expired.
	 */
	protected function getValue($key)
	{
		return $this->_cache->get($key);
	}

	
	/**
	 * Stores a value identified by a key in cache.
	 * This is the implementation of the method declared in the parent class.
	 *
	 * @param string $key the key identifying the value to be cached
	 * @param string $value the value to be cached
	 * @param integer $expire the number of seconds in which the cached value will expire. 0 means never expire.
	 * @return boolean true if the value is successfully stored into cache, false otherwise
	 */
	protected function setValue($key,$value,$expire)
	{
		if(empty($value))
		{
      	     		Yii::log("the setvalue param value is null", CLogger::LEVEL_WARNING);
		}

		return $this->_cache->set($key,$value,0,$expire);
	}

	

	/**
	 * Deletes a value with the specified key from cache
	 * This is the implementation of the method declared in the parent class.
	 * @param string $key the key of the value to be deleted
	 * @return boolean if no error happens during deletion
	 */
	protected function deleteValue($key,$expire)
	{
		return $this->_cache->delete($key, $expire);
	}

        protected function replaceValue($key, $value,$expire)
	{
		
		if(empty($value))
     		{
          		Yii::log("the setvalue param value is null",CLogger::LEVEL_WARNING);
                }
		return $this->_cache->replace($key, $value,0,$expire);
	}

	protected function flushValues()
	{
		return YII::log("CBaeMemcache is not support flush method ",CLogger::LEVEL_WARNING);
	}    
	
	
}




