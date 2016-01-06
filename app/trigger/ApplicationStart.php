<?php
/**
 * Created by PhpStorm.
 * User: kdays
 * Date: 15/12/24
 * Time: 下午6:01
 */

namespace Ice\trigger;

use Akari\Context;
use Akari\system\event\BaseTrigger;
use Akari\system\event\Rule;
use Akari\system\ioc\DI;
use Akari\system\result\Result;
use Akari\system\security\Security;
use Akari\utility\I18n;

class ApplicationStart extends BaseTrigger implements Rule{

    public function process(Result $result = NULL) {
        
    }

}