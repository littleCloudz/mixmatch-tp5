<?php

namespace app\api\controller;
use app\common\controller\User as commonUser;
class User extends commonUser{
	public function demo()
	{
		return $this->showName('zhangxiaoyun22');
	}
}