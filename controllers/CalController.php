<?php
namespace controllers;
use services\URLS;
use Silex\Application;
use Silex\ControllerCollection;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CalController extends Controller
{
protected $layout = 'empty';
    protected function defineActions(ControllerCollection $cal)
    {
        $cal->get(URLS::ALL['CALENDAR'], function (Application $app,$cadate) {
/****************************************************************************************/
/****************************************************************************************/
$link = mysqli_connect("localhost", "ekzeget", "7KV7aBZ6VtJTMFcT") or die('Error connect');
mysqli_set_charset($link, "utf8");
$sel_db=mysqli_select_db($link, 'admin_ekzeget') or die('Error DB select');
/************************************************************************************/
//$today_y = date("Y"); $today_d=date("d.m.Y");
strtotime($cadate) ? $tday=strtotime($cadate) : $tday=strtotime("now"); //Либо считает дату, либо сегодня
$today_y = date("Y", $tday); 
$today_d=date("d.m.Y", $tday);
$today_reserv=$today_d;
/**************************************************************************************************************/
$monthes = array(
    1 => 'Января', 2 => 'Февраля', 3 => 'Марта', 4 => 'Апреля',
    5 => 'Мая', 6 => 'Июня', 7 => 'Июля', 8 => 'Августа',
    9 => 'Сентября', 10 => 'Октября', 11 => 'Ноября', 12 => 'Декабря'
);
$tday1=$tday;
$seg=date('d',$tday1).' '.$monthes[(date('n',$tday1))].' '.date('Y',$tday1);
$rs['seg']=$seg;
$tday2=strtotime("-1 day",$tday);
$seg2=date("d.m.Y",$tday2);
$rs['befor']=$seg2;
$tday3=strtotime("+1 day",$tday);
$seg3=date("d.m.Y",$tday3);
$rs['next']=$seg3;
/*************************************************************************************************************/
$query="SELECT * FROM `pasha` WHERE `py` LIKE '$today_y';";
$result = mysqli_query($link, $query) or die('Error table');
$row = mysqli_fetch_assoc($result);
$datem=$row['dp']; //Пасха в этом году
$segodnya=strtotime($today_d); $pasha=strtotime($datem);
$dopashi=strtotime("-70 day",$pasha); //Пасха -70 дней в этом году
//if($segodnya<$dopashi){$rs[]='Допасхальные чтения';}
//if($segodnya>=$pasha){$rs[]='Постпасхальные чтения';}
if(($segodnya<=$pasha)&&($segodnya>=$dopashi)){
////--------------------------------Постные чтения
$day_read=$pasha-$segodnya;    
date('z', $day_read) ? $dni=date('z', $day_read): $dni=0;
$query="SELECT * FROM `post_chten` WHERE `dni` = '$dni';";
$result = mysqli_query($link, $query) or die('Error table');
while($row = mysqli_fetch_assoc($result))$rs[]=$row; //Если не попали в Пост
} 
else {//-------------Апостольские чтения
$day_read=$segodnya-$pasha;
if($day_read<0){$l_today_y=$today_y-1; $query="SELECT * FROM `pasha` WHERE `py` LIKE '$l_today_y';"; $result = mysqli_query($link, $query) or die('Error table'); $row = mysqli_fetch_assoc($result); $l_pasha=strtotime($row['dp']); $day_read=$segodnya-$l_pasha;}
$dni=date("d.m.Y",$day_read);
$dni=date('z', $day_read);
$query="SELECT * FROM `apostol_chten` WHERE `dni` = '$dni';";
$result = mysqli_query($link, $query) or die('Error table');
while($row = mysqli_fetch_assoc($result))$rs[]=$row; //Если не попали в Пост
}
/**************************************************************************************************************/
/**************************************************************************************************************/
         $hello = $rs;
           return $app->json($hello, 200);
        });
    }
}
