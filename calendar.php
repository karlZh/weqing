<?php

/**
 * Created by PhpStorm.
 * User: user
 * Date: 2017/8/25
 * Time: 16:25
 */
class Calendar
{
    public $year;
    public $month;
    public $day;

    public function __construct()
    {
        $this->year = date('Y');
        $this->month = date('n');
        $this->day = date('j');
    }

    public function setTime($year, $month) {
        $this->year = empty($year) ? date('Y') : $year;
        $this->month = empty($month) ? date('n') : $month;
    }
    public function createCalendar()
    {
        //当前月的第一天
        $firstDayInMonth = mktime(0, 0, 0, $this->month, 1, $this->year);
        //获得当月的总天数
        $daysInMonth = date("t", $firstDayInMonth);
        //获得每个月的第一天，在星期中的第几天
        $firstDay = date("w", $firstDayInMonth);
        //计算数组中的日历表格数
        $tempDays = $firstDay + $daysInMonth;
        //获得表格行数
        $weeksInMonth = ceil($tempDays / 7);
        $counter = 0;
        //创建一个二维数组
        for ($j = 0; $j < $weeksInMonth; $j++) {
            for ($i = 0; $i < 7; $i++) {
                $dayInMonth = $counter;
                //offset the days
                $dayInMonth -= $firstDay;
                $changeDay = $dayInMonth < 0 ? $dayInMonth . " days" : "+{$dayInMonth} days";
                //获取对应天的时间戳
                $dayTime = strtotime($changeDay, $firstDayInMonth);
                //获取日期月份
                $timeMonth = date('n', $dayTime);
                $timeDay = date('j', $dayTime);
                $week [$j] [$i] = array(
                    'day' => $timeDay,
                    'day_time' => $dayTime,
                    'current_month' => $this->month == $timeMonth ? 1 : 0,
                    'current_day' => $this->day == $timeDay ? 1 : 0
                );
                $counter++;
            }
        }
        return array(
            'year' => $this->year,
            'month' => $this->month,
            'week' => $week
        );
    }

    public function showCalendar()
    {
        $str = '<table width="400" border="1" cellpadding="2" cellspacing="2"><tr><th colspan="7">'.date('M', mktime(0, 0, 0, $this->month, 1, $this->year)) . ' ' . $this->year;
        $str .= "</th></tr><tr>
                    <th>Sun</th>
                    <th>Mon</th>
                    <th>Tue</th>
                    <th>Wed</th>
                    <th>Thur</th>
                    <th>Fri</th>
                    <th>Sat</th>
                </tr>";
        $calendar = $this->createCalendar();
        $week = $calendar['week'];
        foreach ($week as $key => $val) {
            $str .= "<tr>";
            for ($i = 0; $i < 7; $i++) {
                $style = $val [$i]['current_month'] ? ($val [$i]['current_day'] ? ' style="background-color:blue;"' : '') : ' style="color:#ccc;"';
                $str .= "<td align='center'" . $style . ">" . $val [$i]['day'] . "</td>";
            }
            $str .= "</tr>";
        }
        $str .= "</table>";
        echo $str;
    }
}
$calendar = new Calendar();
$calendar->setTime('2016','08');
//echo $calendar->year;
//echo $calendar->month;
$calendar->showCalendar();
exit;
$cal = $calendar->createCalendar();
echo "<pre>";
print_r($cal);
echo "</pre>";
?>
<!--var_dump($daysInMonth,$firstDay);-->