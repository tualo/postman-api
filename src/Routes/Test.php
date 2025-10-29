<?php

namespace Tualo\Office\PostmanAPI\Routes;

use Tualo\Office\Basic\TualoApplication as App;
use Tualo\Office\Basic\Route;
use Tualo\Office\Basic\IRoute;
use WebScientist\Postman\Services\PostmanService as Postman;

class Test extends \Tualo\Office\Basic\RouteWrapper
{

    public static function register()
    {

        Route::add('/postman-api/test', function () {
            $db = App::get('session')->getDB();
            App::contenttype('application/json');
            try {

                $postman = new Postman();
                $collection = $postman->collection('postmanapi');
                $req = $collection->request('postmanapi test', 'GET');
                $req->url('postman-api/test');

                App::result('collection', $collection->jsonSerialize());
            } catch (\Exception $e) {
                App::result('msg', $e->getMessage());
            }
        }, array('get'), true);
    }
}
