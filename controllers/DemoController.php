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
$query="SELECT SUBSTRING(`Bible`.`pointer`,-3,3) AS NumStih,`Bible`.`pointer`,`Bible`.`contents`, `version`.`abbreviation` FROM `Bible` LEFT JOIN `version` ON `Bible`.`version_id`=`version`.`id` WHERE `Bible`.`pointer` BETWEEN '$demos' AND '$demos1';";
$result = mysqli_query($link, $query) or die('Error db');
while($row = mysqli_fetch_assoc($result))$rs[]=$row;
/************************************************************************************/
$l_demo=strlen($demos); $l_demo2=substr($demos,-6,3);$l_demo3=substr($demos,-3,3); $r_demo3=substr($demos1,-3,3);
switch ($l_demo){
    case 10: $l_demo1=substr($demos,-8,2);break;
    case 9: $l_demo1=substr($demos,-8,2);break;
    case 8: $l_demo1=substr($demos,-8,2);break;
    case 7: $l_demo1=substr($demos,-7,1);break;
                }
$query="SELECT `abbreviation` FROM `book_i18n` WHERE `number` = '$l_demo1' AND `locale` LIKE 'ru_RU';";
$result = mysqli_query($link, $query) or die('Error db');
while($row = mysqli_fetch_assoc($result))$rs_book=$row['abbreviation'];
/************************************************************************************/
$pass['passages']= $rs;    
$pass['book']= array($rs_book.'.'.(int)$l_demo2.':'.(int)$l_demo3.'-'.(int)$r_demo3);
         $hello = $pass;
           return $app->json($hello, 200);
        });
    }
}

