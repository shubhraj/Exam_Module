<?php
require_once ('DBcon.php');
require_once ('session.php');
	class User{
		const COLLECTON ='users';
		private $_mongo;
		private $_collection;
		private $_user;
		public function __construct(){
			$this->_mongo=DBConnection::instantiate();
			$this->_collection=$this->_mongo->getCollection(User::COLLECTON);
			if ($this->isLoggedIn()) $this->_loadData();
		}
		
		public function isLoggedIn(){
			return isset($_SESSION['user_id']);
		}
		
		public function authenticate($rno,$password){
			$query = array(
				'rno'=>$rno,
				'password'=>$password
			);
			$this->_user=$this->_collection->findOne($query);
			if(empty($this->_user)) return false;
			$_SESSION['user_id'] = (string) $this->_user['_id'];
			return true;
		}
		//------------------------------------------------check subject selection
		public function validate($rno,$subject){
			$query = array(
			);
			$this->_user=$this->_collection->findOne($query);
			if(empty($this->_user)) return false;
			$_SESSION['user_id'] = (string) $this->_user['_id'];
			return true;
		}
		//------------------------------------------------check subject selection
		
		public function logout()
		{
			unset($_SESSION['user_id']);
		}
		public function __get($attr)
		{
			if (empty($this->_user))
				return Null;
			switch($attr) {
				
				case 'rno':
					return $this->_user['rno'];
				//case 'name':
					//$name = $this->_user['name'];
						//return sprintf('first: %s, last: %s', $name['first'],
							//$name['last']);
				case 'password':
					return NULL;
				default:
					return (isset($this->_user[$attr])) ?
					$this->_user[$attr] : NULL;
			}
		}
		private function _loadData()
		{
			$id = new MongoId($_SESSION['user_id']);
			$this->_user = $this->_collection->findOne(array('_id'
					=> $id));
		}
		
		
	}
?>