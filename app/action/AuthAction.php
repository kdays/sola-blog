<?php
/**
 * Created by PhpStorm.
 * User: kdays
 * Date: 16/1/4
 * Time: 上午10:29
 */

namespace Ice\action;


use Akari\action\BaseAction;
use Ice\config\Auth;
use Ice\exception\BackendExceptionHandler;
use Ice\lib\PasswordUtil;

class AuthAction extends BaseAction{
    
    public function _pre() {
        $this->_setExceptionHandler(BackendExceptionHandler::class);
    }
    
    public function authAction() {
        return $this->_genTplResult([
            'siteId' => Auth::SITE_ID
        ]);
    }
    
    public function doAuthAction() {
        $password = $this->request->getPost("pwd");
        $newPwd = PasswordUtil::getPassword();
        
        if ($newPwd != $password) {
            throw new \Exception("System Err.1");
        }
        
        $this->response->setCookie("auth", md5($newPwd), "/", TRUE);
        return $this->_alertRedirect("Success!", "/backend/welcome");
    }
    
}