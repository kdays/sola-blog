<?php
/**
 * Created by PhpStorm.
 * User: kdays
 * Date: 15/12/28
 * Time: 下午4:54
 */

namespace Ice\action;


use Akari\action\BaseAction;
use Akari\Context;
use Akari\system\http\Cookie;
use Ice\config\Auth;
use Ice\exception\BackendExceptionHandler;
use Ice\lib\PasswordUtil;

class BackendAction extends BaseAction{

    public function _pre() {
        $this->_setExceptionHandler(BackendExceptionHandler::class);
        
        $value = $this->request->getCookie("auth");
        $newPwd = PasswordUtil::getPassword();
        
        if ($value != md5($newPwd)) {
            throw new \Exception("timeout!");
        }
    }
    
    public function welcomeAction() {
        return $this->_genTplResult([]);
    }
    
    public function listAction() {
        $lists = json_decode(file_get_contents(Context::$appConfig->dbJsonPath));
        $count = count($lists);
        
        return $this->_genTplResult([
            'lists' => $lists,
            'count' => $count
        ]);
    }
    
    public function addAction() {
        
    }
    
    public function removeAction() {
        $id = $this->request->getPost("id");
        if (!is_numeric($id)) {
            $this->errorMessage("ID错误");
        }
        
        $id = $id - 1;

        $lists = json_decode(file_get_contents(Context::$appConfig->dbJsonPath), TRUE);
        if (!isset($lists[$id])) {
            $this->errorMessage("没有找到");
        }
        
        unset($lists[$id]);
        file_put_contents(Context::$appConfig->dbJsonPath, json_encode($lists));
        return $this->_alertRedirect("删除成功", "/backend/list");
    }
    
    public function uploadAction() {
        return $this->_genTplResult([]);
    }
    
    public function doUploadAction() {
        $upload = $this->request->getUploadedFile("upload");
        if (!$upload) {
            return $this->_alertRedirect("没有文件");
        }
        
        if ($upload->getExtension() != "epub") {
            return $this->_alertRedirect("不是EPUB");
        }
        
        $maxId = $this->getMaxId();
        $path = "/epub/". $maxId . "_". md5_file($upload->getTempPath()). ".epub";
        
        $title = $this->request->getPost("name");
        $about = $this->request->getPost("about");
        
        $upload->save($path);

        $lists = json_decode(file_get_contents(Context::$appConfig->dbJsonPath), TRUE);
        $lists[ $maxId ] = [
            'createAt' => TIMESTAMP,
            'title' => $title,
            'content' => $about,
            'path' => $path
        ];
        
        file_put_contents(Context::$appConfig->dbJsonPath, json_encode($lists));
        return $this->_alertRedirect("添加成功");
    }
    
    private function getMaxId() {
        $lists = json_decode(file_get_contents(Context::$appConfig->dbJsonPath), true);
        $id = max(array_keys($lists));
        
        return $id + 1;
    }
    
    public function backupAction() {
        $lists = json_decode(file_get_contents(Context::$appConfig->dbJsonPath));
        return $this->_genJSONResult($lists);
    }
    
    protected function errorMessage($msg) {
        throw new \Exception($msg);
    } 
}