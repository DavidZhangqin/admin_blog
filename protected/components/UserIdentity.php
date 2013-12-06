<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate()
	{
		$user = User::model()->findByAttributes(array('username'=>$this->username));
		if($user === null) {
			$this->errorCode=self::ERROR_USERNAME_INVALID;
		} elseif($user->password !== $this->encrypt($this->password)) {
			$this->errorCode=self::ERROR_PASSWORD_INVALID;
		} else {
			$this->_id = $user->user_id;
			if (null === $user->last_login_time) {
				$lastLogin = time();
			} else {
				$lastLogin = strtotime($user->last_login_time);
			}
			$this->setState('lastLoginTime', $lastLogin);
			$this->errorCode=self::ERROR_NONE;
		}
		return !$this->errorCode;
	}

	public function getId() {
		return $this->_id;
	}

	protected function encrypt($value) {
		return md5($value);
	}
}