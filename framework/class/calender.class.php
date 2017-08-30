<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/8/25
 * Time: 11:58
 */
class Calendar
{
    var $T = array();
    var $MonthDays = array('1'=>'31','2'=>'28','3'=>'31','4'=>'30','5'=>'31','6'=>'30','7'=>'31','8'=>'31','9'=>'30','10'=>'31','11'=>'30','12'=>'31');
    var $Week=array('0'=>'日','1'=>'一','2'=>'二','3'=>'三','4'=>'四','5'=>'五','6'=>'六');
    var $Y,$M,$D;
    function __construct()
    {
        date_default_timezone_set ('prc');
        $this->Y=isset($_GET['year']) ? $_GET['year'] : date("Y");
        $this->M=isset($_GET['month']) ? $_GET['month'] : date("m");

        /*      $this->Y=date('Y');
                $this->M=date('m');
        */      $this->D=date('j');
    }
    function SetTime($Y,$M,$D)
    {
        $this->Y=$Y;
        $this->M=$M;
        $this->D=$D;
    }
    function IsLeapYear()
    {
        return ($this->Y%400==0 || ($this->Y%4==0 && $this->Y%100<>0)) ? 1 : 0;
    }

    function GetMouFirDayWeek()
    {
        $time = mktime(0,0,0,$this->M,1,$this->Y);
        $time = getdate($time);
        return $time['wday'];
    }
    function ShowCalendar()
    {
        $IsLeapY = $this->IsLeapYear();
        $this->datesOFmonth[2] = $IsLeapY==1 ? 29: 28;
        ?>
        <style type="text/css">
            .calendartb
            {
                border-collapse: collapse;
                border-spacing: 0px;
                empty-cells: show;
                font-family: microsoft yahei;
            }
            td
            {
                font-size: 12px;
                text-align: center;
                padding:2px 5px 2px 6px;
            }
            .calendartb a
            {
                text-decoration: none;
            }
            .calendartb a:hover
            {
                color:rgb(255,0,0);
            }
        </style>
        <meta charset="utf-8">
        <div style="border:1px solid rgb(0,0,0);width:180px">
            <table class="calendartb "style="width:180px;border-bottom:1px solid rgb(0,0,0);">
                <tr>
                    <td>
                        <a href="<?php echo $this->PreYear($this->Y,$this->M);?>"><<</a>
                    </td>
                    <td>
                        <a href="<?php echo $this->PreMouth($this->Y,$this->M);?>"><</a>
                    </td>
                    <td>
                        <a href="?"style="color:rgb(0,0,0);"><?php echo $this->Y."年".$this->M."月";?></a>
                    </td>
                    <td>
                        <a href="<?php echo $this->NexMouth($this->Y,$this->M);?>">></a>
                    </td>
                    <td>
                        <a href="<?php echo $this->NexYear($this->Y,$this->M);?>">>></a>
                    </td>
                </tr>
            </table>
            <table class="calendartb ">
                <tr>
                    <td>日</td>
                    <td>一</td>
                    <td>二</td>
                    <td>三</td>
                    <td>四</td>
                    <td>五</td>
                    <td>六</td>
                </tr>
                <tr>
                    <?php
                    for ($s=0;$s<$this->GetMouFirDayWeek();$s++)
                        echo '<td></td>';
                    for ($i=1;$i<=$this->MonthDays[$this->M];$i++)
                    {
                        if (($i+$s)%7==1)
                            echo '</tr><tr>';
                        if ($i==$this->D)
                            echo "<td style=\"color:rgb(255,0,0);font-weight:bold;\">$i</td>";
                        else
                            echo "<td>$i</td>";
                    }
                    ?>
                </tr>
            </table>
        </div>
        <?php
    }

    private function PreMouth($thisY,$thisM)
    {
        if ($thisM==1)
        {
            $thisY=$thisY-1;
            $thisM=12;
        }
        else
        {
            $thisM=$thisM-1;
        }
        return '?year='.$thisY.'&month='.$thisM;
    }
    private function NexMouth($thisY,$thisM)
    {
        if ($thisM==12)
        {
            $thisY=$thisY+1;
            $thisM=1;
        }
        else
        {
            $thisM=$thisM+1;
        }
        return '?year='.$thisY.'&month='.$thisM;
    }
    private function PreYear($thisY,$thisM)
    {
        $thisY=$thisY-1;
        return '?year='.$thisY.'&month='.$thisM;
    }
    private function NexYear($thisY,$thisM)
    {
        $thisY=$thisY+1;
        return '?year='.$thisY.'&month='.$thisM;
    }
}