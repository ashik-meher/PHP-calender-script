<?php 


error_reporting(E_ALL);
ini_set('display_errors', 1);


class Calender {
    private $month;
    private $year;
    private $days_of_week;
    private $num_days;
    private $date_info;
    private $day_of_week;
  


    public function __construct($month, $year, $days_of_week = array('S', 'M', 'T', 'W', 'Th', 'F', 'S')){


        $this->month = $month;
        $this->year = $year;
        $this->days_of_week = $days_of_week;
        $this->num_days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
        $this->date_info = getdate(strtotime('first day of', mktime(0,0,0,$this->month, 1, $this->year)));
        $this->day_of_week = $this->date_info['wday'];


    }

    public function show(){
        $output = '<table class="calender">';

        $output .= '<caption>'. $this->date_info['month'].''. $this->year. '</caption>';

        $output .= '<tr>';


        //Days of the week header with day names

        foreach( $this->days_of_week as $day){

            $output .= '<th class="header">'. $day . '</th>';

        }

        //Close header row and open first row of original days

        $output .= '</tr><tr>';

        //if first day of month deos not fall on a sunday, then we need to fill beginning space using colspan
        //assiging the correct position of the date in context of week day 
        //starting the calender
        if ($this->day_of_week > 0){
            $output .= '<td colspan="'.$this->day_of_week.'"> </td>';
        }

        //start num_days counter , date counter of the month

        $current_day = 1;

        //looping and buiding days

        while($current_day < $this->num_days){

            ////Resest days of week counter and closing each row at the end of row


            if ($this->day_of_week == 7){
                $this->day_of_week =0;
                $output .= '</tr><tr>';

            }


            ////Build each day

            $output .= '<td class="day">'.$current_day. '</td>';

            //Incrementing the current_day value

            $current_day++;

            // week day counter increments for next week positioning

            $this->day_of_week++;
            //ending while loop for generating days  
               
        }

        // Filling the remainings day spaces of the month with colspan

        if ($this->day_of_week !=7){

            $remaining_days = (7- $this->day_of_week);
            $output .= '<td colspan="'.$remaining_days.'" ></td>';
        }

        //closing final row and table

        $output .= '</tr></table>';

        echo $output;

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calender</title>

    <link rel="stylesheet" href="style.css">

</head>
<body>
 <?php

 $calender = new Calender(3, 2021);

 $calender->show();

 ?>

    
</body>
</html>
