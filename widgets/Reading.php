<?php
namespace widgets;


use Silex\Application;

class Reading extends Widget
{
    protected $chosenDate;

    public function run()
    {
       /* $planall = mysql_query("SELECT * FROM host1222968_pass.plan WHERE name LIKE '$name_user' LIMIT 1");
                        if (mysql_num_rows($planall) > '0' ) {
                            $plan=mysql_fetch_array($planall);

                            $data_plan = $plan['nachalo'];
                            $data_today_plan=Date('d.m.Y');

                            $num_rasp = floor((strtotime("$data_today_plan")-strtotime("$data_plan"))/(60*60*24))+1;
                            if ($plan['prochitano'])
                                $proch_pl = split(" ", $plan['prochitano']);
                            $proch_pl= sizeof($proch_pl);
                            if ($plan['nazvan'] == 'post') $col_day_it = '40';
                            if ($plan['nazvan'] == 'nz+opt') $col_day_it = '89';
                            if ($plan['nazvan'] == 'all+3') $col_day_it = '1095';
                            if (empty($col_day_it)) $col_day_it = '365';

                            if ($proch_pl < $num_rasp && $proch_pl < $col_day_it)
                            {
                                $plan_red='1';
                            }
                        }*/

        /* if ($auth==2 || $auth==1) {
             echo 'Здравствуйте, <a id="toggler1"><b>'.$name_user.'</b></a>';
             if ($plan_red && $plan_red == '1') echo ' <a href="http://'.$url_pl.'plan_posl=yes"><img src="/web/assets/img/bell_plan.png" style="width:16px; margin-bottom: -4px" title="У Вас не прочитан план чтения Библии" /></a>';
         }*/






//###############FILES/chten.php##########
        /*
<?php
function Zakladki ($color, $tolk, $num) {
preg_match_all ('/(\d*\s*[а-яёА-Я]+)\.\s(\d{1,3})\:*(\d*)/', $color, $arr_zak, PREG_PATTERN_ORDER );
$kn_z=$arr_zak[1][0];
$gl_z=$arr_zak[2][0];
$st_z=$arr_zak[3][0];
echo '<a href="glava.php?kn_rus='.$kn_z.'&tolk='.$tolk.'&gl='.$gl_z; if ($st_z) echo '&marker_st='.$st_z.'#'.$st_z; echo '"><div class="'.$num.'">'.$color.'</div></a>';
}
if (empty($name_user)) $name_user=$_SESSION['name_user'];
    include 'FILES/connect.php';
if ($name_user) { echo '<div id="zakladki" style="position: absolute; margin: 330px 0 0 -130px;text-align: right; width: 125px ;">';

 $zak = mysql_query("SELECT * FROM host1222968_pass.zakladki WHERE name LIKE '$name_user' LIMIT 1");
$f_zak = mysql_fetch_array($zak);
if ($f_zak['red']) Zakladki ($f_zak['red'], $tolk, 'zaklad1');
if ($f_zak['orange']) Zakladki ($f_zak['orange'], $tolk, 'zaklad2');
if ($f_zak['green']) Zakladki ($f_zak['green'], $tolk, 'zaklad3');
if ($f_zak['blue']) Zakladki ($f_zak['blue'], $tolk, 'zaklad4');
if ($f_zak['fuchsia']) Zakladki ($f_zak['fuchsia'], $tolk, 'zaklad5');

echo '</div>';
};
?>
<img src="IMG/loading.gif" id="loading" />

<div id="response">
<?php
if ($_GET['data_today']) $data_today = $_GET['data_today'];
if ($_POST['data_today']) {
$data_today = $_POST['data_today'];
$dd_today = substr($data_today,8,2); // День
$mm_today = substr($data_today,5,2); // Месяц
$yy_today = substr($data_today,0,4); // Год
$data_today= $dd_today.'.'.$mm_today.'.'.$yy_today;
}
else {
$dd_today = substr($data_today,0,2); // День
$mm_today = substr($data_today,3,2); // Месяц
$yy_today = substr($data_today,6,4); // Год

}

if (!isset ($data_today)) {
$data_today=Date('d.m.Y');

$dd_today = substr($data_today,0,2); // День
$mm_today = substr($data_today,3,2); // Месяц
$yy_today = substr($data_today,6,4); // Год
}
$dat_pred=date ("d.m.Y", mktime(0, 0, 0, $mm_today, $dd_today-1, $yy_today));
$dat_sled=date ("d.m.Y", mktime(0, 0, 0, $mm_today, $dd_today+1, $yy_today));

      include 'FILES/connect.php';
        */


        $res = $this->getHeader();
        /*
         include 'FILES/chtenija.php';




        $patterns = array ('/\s?(\d?\s?[а-яА-Я]{2,5})\.\s(\d{1,2})\:((\d{1,2})[^;]*);?/');
            $replace = array ('<a href="glava.php?kn_rus=${1}&gl=${2}&marker_st=${3}&tolk='.$tolk.'&data_today='.$data_today.'#${4}">${1}. ${2}:${3}</a> ');
            $apostol_chten = preg_replace($patterns, $replace, $apostol_chten);
            $evang_chten = preg_replace($patterns, $replace, $evang_chten);
            $utr_chten = preg_replace($patterns, $replace, $utr_chten);
            $dop_chten = preg_replace($patterns, $replace, $dop_chten);

        $patterns = array ('/\>\s\</', '/(\S)\<a\s/', '/\>\s/', '/\s*$/', '/\n/');
            $replace = array ('>, <', '${1} <a ', '>', '', '<br />');
            $apostol_chten = preg_replace($patterns, $replace, $apostol_chten);
            $evang_chten = preg_replace($patterns, $replace, $evang_chten);
            $utr_chten = preg_replace($patterns, $replace, $utr_chten);
            $dop_chten = preg_replace($patterns, $replace, $dop_chten);
            $apostol_chten = preg_replace('/;/', '', $apostol_chten);
            $evang_chten = preg_replace('/;/', '', $evang_chten);
            $utr_chten = preg_replace('/;/', '', $utr_chten);
            $dop_chten = preg_replace('/;/', '', $dop_chten);


        echo '
        <div class="p_content3"><div id="page_content3" class="scroll-pane1">';

        ###########
        for ($s=0; $s<sizeof($nazvan); $s++)
        {

        $chnazvan = $nazvan[$s];
         $prnaz = mysql_query("SELECT * FROM host1222968_pass.propovedi WHERE povod LIKE '$chnazvan%' LIMIT 1");
        if (mysql_num_rows($prnaz) > 0) {
        $prnaz = mysql_fetch_array($prnaz);

        echo '<div style="text-align: center"><span class="ssilki_v_chten"';
        if ($col_naz) echo ' id= "chten_'.$col_naz.'"';
        echo '><a href="propoved.php?povod='.$prnaz['povod'].'&data_today='.$data_today.'">'.$chnazvan.'</a></span>';

        }
        else {
        echo '<div style="text-align: center"><span style=" font-size: 14px;';
        if ($col_naz) echo 'color: '.$col_naz;
        echo '">'.$chnazvan.'</span>';
        }

        echo '</div>';
        }
        #########

        echo '<hr style="width:100%;" /><span style=" font-size: 14px;">';
        if ($utr_chten) echo '<b>Утреня:</b> <span style="color:#666">'.$utr_chten.'</span><br />';
        if ($apostol_chten && $evang_chten) echo '<b>Литургия:</b> Ап.: <span style="color:#666">'.$apostol_chten.',</span> Ев.: <span style="color:#666">'.$evang_chten.'</span><br />';
        elseif ($evang_chten) echo '<b>Литургия:</b> Ев.: <span style="color:#666">'.$evang_chten.'</span><br />';
        if ($dop_chten) echo '<span style="color:#666">'.$dop_chten.'</span><br />';
        echo '</span>';


            echo '</div>
        </div>
        ';


        ###################
        $_SERVER["REQUEST_URI"] = preg_replace('/\&data_today\=\d\d\.\d\d\.\d\d\d\d/', '', $_SERVER["REQUEST_URI"]);

        if (preg_match_all ("/\?/", $_SERVER["REQUEST_URI"], $massiv)) $ku = '&';
        else $ku = '?';
        echo '<div id="zavtr_chten"><input id="dat_send" type="hidden">';


        echo '<noindex><a onclick="$(\'#dat_send\').attr(\'value\', \''.$dat_pred.'\'); SendRequest();" rel="nofollow" title="Предыдущий день">&#8592; Пред.</a> <span style="color: #c4c4c4;">|</span> ';
        if ($data_today != Date('d.m.Y')) echo '<a onclick="$(\'#dat_send\').attr(\'value\', \''.Date('d.m.Y').'\');SendRequest();" rel="nofollow" title="Сегодняшние чтения">Сегодня</a> <span style="color: #c4c4c4;">|</span> '; else echo '<a style="color: #c4c4c4; cursor: text;text-decoration: none;">Сегодня</a> <span style="color: #c4c4c4;">|</span> ';
        echo '<a onclick="$(\'#dat_send\').attr(\'value\', \''.$dat_sled.'\');SendRequest();" rel="nofollow" title="Следующий день">След. &#8594;</a></noindex>';
        echo '</div>';
        ?>

        </div>


                 */
//###############FILES/chten.php##########



        //  if ($name_user) include 'plan_chten.php';

        return $res;
    }

    private function getHeader()
    {
        $app = get_app();

        $chosenTimestamp = isset($this->chosenDate)
            ? strtotime($this->chosenDate)
            : strtotime(date('Y-m-d'));

        return $this->render('readings_header', [
            'dayAdverb' => $this->getRelativeAdverbForDay($app, $chosenTimestamp),
            'chosenMonthName' => strftime('%B', $chosenTimestamp),
            'chosenYear' => date('Y', $chosenTimestamp),
        ]);
    }

    /**
     * @param Application $app
     * @param $chosenTimestamp
     * @return string
     */
    private function getRelativeAdverbForDay(Application $app, $chosenTimestamp)
    {
        switch ($chosenTimestamp) {
            case strtotime('yesterday'):
                $dayAdverb = $app['translator']->trans('yesterday');
                break;
            case strtotime('today'):
                $dayAdverb = $app['translator']->trans('today');
                break;
            case strtotime('tomorrow'):
                $dayAdverb = $app['translator']->trans('tomorrow');
                break;
            default:
                $dayAdverb = '';
        }
        return $dayAdverb;
    }
}