<?php
/**
 * Created by PhpStorm.
 * User: kdays
 * Date: 15/9/17
 * Time: 上午8:43
 */

$di = \Akari\system\ioc\DI::getDefault();

/**
 * use .phtml
 */
$di->setShared("viewEngine", function() {
    return new \Akari\system\tpl\engine\RawTemplateEngine();
});

/**
$di->setShared("logger", function() {
    $logger = new \Akari\system\logger\handler\SeasLoggerHandler();
    return $logger;
});
 * **/