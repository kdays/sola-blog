<?php
/**
 * Created by PhpStorm.
 * User: kdays
 * Date: 15/12/24
 * Time: 下午6:00
 */

namespace Ice\trigger;

use Akari\system\event\BaseTrigger;
use Akari\system\event\Rule;
use Akari\system\result\Result;

class AfterInit extends BaseTrigger implements Rule{

    public function process(Result $result = NULL) {
        
    }
    
}