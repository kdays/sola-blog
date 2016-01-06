<?php
/**
 * Created by PhpStorm.
 * User: kdays
 * Date: 15/7/3
 * Time: 下午11:30
 */

namespace Ice\widget;

use Akari\system\result\Widget;

class Pager extends Widget{

    public function execute($userData = NULL) {
        return [
            'pages' => $userData
        ];
    }

}