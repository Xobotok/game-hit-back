<?php

namespace app\controllers;

use Yii;
use yii\rest\Controller;


class BaseController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                // restrict access to
                'Origin' => ['*'],
                // Allow  methods
                'Access-Control-Request-Method' => ['POST', 'PUT', 'OPTIONS', 'GET'],
                // Allow only headers 'X-Wsse'
                'Access-Control-Request-Headers' => ['*'],
                'Access-Control-Allow-Headers' => ['Content-Type', 'Authorization', 'User'],
                // Allow credentials (cookies, authorization headers, etc.) to be exposed to the browser
                //'Access-Control-Allow-Credentials' => true,
                // Allow OPTIONS caching
                'Access-Control-Max-Age' => 3600,
                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                'Access-Control-Expose-Headers' => ['*'],
            ],
        ];
        return $behaviors;
    }
    public function get() {
        return (object)Yii::$app->request->get();
    }
    public function createAnswer($status = 1, $data = '', $message = '') {
        $result = (object)[];
        $result->ok = $status;
        $result->data = $data;
        $result->message = $message;
        return $result;
    }
}
