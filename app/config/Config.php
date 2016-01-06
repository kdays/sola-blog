<?php
/**
 * Created by PhpStorm.
 * User: kdays
 * Date: 15/12/28
 * Time: 下午4:56
 */

namespace Ice\config;


use Akari\config\BaseConfig;

class Config extends BaseConfig{

    public $appName = "Faker";
    public $appBaseURL = "/";
    
    public $dbJsonPath = __DIR__. "/../../data/db.json";
    
    public $epubPath = "/epub/";
    public $templateSuffix = '.phtml';
    
    public $notFoundTemplate = "404";
   // public $serverErrorTemplate = "500";
    
    public $templateNamePrefix = "win98/";
    
}