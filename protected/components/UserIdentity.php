<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{

	public function authenticate($token=null)
	{
		if ($token != null) {
			$pegawai = Pegawai::model()->findByAttributes(array('token'=>$token));

			if ($pegawai !== null) {
				$this->username = $pegawai->username;
				$this->setState('fromTable', 'pegawai');
				$this->errorCode=self::ERROR_NONE;
			} else {
				$this->errorCode=self::ERROR_UNKNOWN_IDENTITY;
			}
		} else {
			$user=User::model()->findByAttributes(array('username'=>$this->username));
			$pegawai=Pegawai::model()->findByAttributes(array('username'=>$this->username));
			if($user!==null) 
			{
				if(CPasswordHelper::verifyPassword($this->password,$user->password))
				{	
					$this->setState('fromTable', 'user');
					$this->errorCode=self::ERROR_NONE;
					
				} else {
					$this->errorCode=self::ERROR_PASSWORD_INVALID;
				}					
			} elseif ($pegawai !==null) {

				if(CPasswordHelper::verifyPassword($this->password,$pegawai->password))
				{	
					$this->setState('fromTable', 'pegawai');
					$this->errorCode=self::ERROR_NONE;
					
				} else {
					$this->errorCode=self::ERROR_PASSWORD_INVALID;
				}
			} else {
				$this->errorCode=self::ERROR_USERNAME_INVALID;
			}
		}
		return !$this->errorCode;
	}
}