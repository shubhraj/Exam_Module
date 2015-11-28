<?php
require_once 'DBcon.php';
class SessionManager{
	const COLLECTION = 'sessions';	//store sessions
	const SESSION_TIMEOUT = 3600;
	const SESSION_LIFE = 3600;
	const SESSION_NAME = 'mongosessid';
	const SESSION_COOKIE_PATH = '/';
	const SESSION_COOKIE_DOMAIN='';	//change if not localhost server with address
	private $_mongo;
	private $_collection;
	private $_currentSession;
	
	public function __construct(){
		$this->_mongo = DBConnection::instantiate();
		$this->_collection= $this->_mongo->getCollection(SessionManager::COLLECTION);
		
		session_set_save_handler(
			array(&$this, 'open'),
			array(&$this, 'close'),
			array(&$this, 'read'),
			array(&$this, 'write'),
			array(&$this, 'destroy'),
			array(&$this, 'gc')
		);
		
		ini_set('session.gc_maxlifetime', SessionManager::SESSION_LIFE);
		session_set_cookie_params(
			SessionManager::SESSION_LIFE,
			SessionManager::SESSION_COOKIE_PATH,
			SessionManager::SESSION_COOKIE_DOMAIN
		);
		session_name(SessionManager::SESSION_NAME);
		session_cache_limiter('nocache');
		//start the session
		session_start();
	}
	public function open($path,$name){return true;}
	public function close(){return true;}
	public function read($sessionId){
		$query = array(
			'session_id' => $sessionId,
			'timedout_at' => array('$gte' => time()),
			'expire_at' => array('$gte' => time() - SessionManager::SESSION_LIFE)
		);
		$result = $this->_collection->findOne($query);
		$this->_currentSession = $result;
		
		if(!isset($result['data']))	{
			return '';
		}
		return $result['data'];
	}
	public function write($sessionId,$data){
		$expired_at = time() + self::SESSION_TIMEOUT;
		$new_obj = array(
				'data'=> $data,
				'timeout_at' => time()+self::SESSION_TIMEOUT,
				'expired_at' =>
				(empty($this->_currentSession)) ?
				time()+ SessionManager::SESSION_LIFE
				: $this->_currentSession['expired_at']
		);
		$query = array('session_id' => $sessionId);
		$this->_collection->update(
				$query,
				array('$set' => $new_obj),
				array('upsert' => True)
		);
		
		
		return True;
	}
	
	public function destroy($sessionId)
	{
		$this->_collection->remove(array('session_id' =>
				$sessionId));
		return True;
	}
	public function gc()
	{
		$query = array( 'expired_at' => array('$lt' => time()));
		$this->_collection->remove($query);
		return True;
	}
	public function __destruct()
	{
		session_write_close();
	}
}
//initiate the session
$session = new SessionManager();
?>