<?php
/**
 * Created by PhpStorm.
 * User: kdays
 * Date: 16/1/4
 * Time: 上午11:14
 */

namespace Ice\exception;


use Akari\system\exception\BaseExceptionHandler;

class BackendExceptionHandler extends BaseExceptionHandler{

    public function handleException(\Exception $ex) {
        return $this->_genTEXTResult($ex->getMessage());
    }
}