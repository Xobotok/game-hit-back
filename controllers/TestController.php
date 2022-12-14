<?php

namespace app\controllers;

class TestController extends BaseController
{
    public function actionTest() {
        return var_dump('123');
    }
}