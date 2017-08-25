<?php
namespace controllers;
use services\URLS;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DemoController extends Controller
{
protected $layout = 'empty';
    protected function defineActions(ControllerCollection $demo)
    {
        $demo->get(URLS::ALL['DEMO'], function (Application $app, $demos, $demos1) {
/************************************************************************************/
$link = mysqli_connect("localhost", "ekzeget", "7KV7aBZ6VtJTMFcT") or die('Error connect');
mysqli_set_charset($link, "utf8");
$sel_db=mysqli_select_db($link, 'ekzeget') or die('Error select');
$query="SELECT `Bible`.`pointer`,`Bible`.`contents`, `version`.`abbreviation` FROM `Bible` LEFT JOIN `version` ON `Bible`.`version_id`=`version`.`id` WHERE `Bible`.`pointer` BETWEEN '$demos' AND '$demos1';";
$result = mysqli_query($link, $query) or die('Error db');
while($row = mysqli_fetch_assoc($result))$rs[]=$row;
/************************************************************************************/
         $hello = $rs;
           return $app->json($hello, 200);
        });
    }
}

