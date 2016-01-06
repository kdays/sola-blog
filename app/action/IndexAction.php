<?php
/**
 * Created by PhpStorm.
 * User: kdays
 * Date: 15/12/28
 * Time: 下午5:06
 */

namespace Ice\action;


use Akari\action\BaseAction;
use Akari\Context;
use Akari\utility\PageHelper;
use Ice\config\Config;

class IndexAction extends BaseAction{

    public function _pre() {
        $this->_setLayout(Context::$appConfig->templateNamePrefix. "/front");
    }
    
    public function indexAction() {
        $lists = json_decode(file_get_contents(Context::$appConfig->dbJsonPath), TRUE);
        $page = $this->request->getQuery("page", 1);
        $pageSize = 3;

        $count = count($lists);
        $lists = array_slice($lists, ($page - 1) * $pageSize, $pageSize, TRUE);
        
        $pages = PageHelper::getInstance()
            ->setPageSize($pageSize)
            ->setTotalCount($count)
            ->setCurrentPage($page)
            ->setUrl("/index?page=(page)")
            ->execute();
        
        return $this->_genTplResult([
            'pages' => $pages,
            'epubPath' => Context::$appConfig->epubPath,
            'lists' => $lists
        ]);
    }
    
    public function postAction() {
        $id = (int)$this->request->getQuery("id");   
        if (!is_numeric($id)) {
            return $this->_alertRedirect("not found");
        }

        $lists = json_decode(file_get_contents(Context::$appConfig->dbJsonPath), TRUE);
        if (!isset($lists[$id - 1])) {
            return $this->_alertRedirect("not found");
        }
        
        return $this->_genTplResult([
            'detail' => $lists[$id - 1],
            'id' => $id
        ]);
    }
}