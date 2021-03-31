<?php


//error_reporting(E_ALL);

error_reporting(1);
ini_set('display_errors', 1);


class Calender
{
    private $month;
    private $year;
    private $days_of_week;
    private $num_days;
    private $date_info;
    private $day_of_week;



    //new ones
    //private $current_day_info;

    public $all_current_day_info;
    public $current_day_info;

    public $current_day;




    public function __construct($month, $year, $days_of_week = array('S', 'M', 'T', 'W', 'Th', 'F', 'S'))
    {


        $this->month = $month;
        $this->year = $year;
        $this->days_of_week = $days_of_week;
        $this->num_days = cal_days_in_month(CAL_GREGORIAN, $this->month, $this->year);
        $this->date_info = getdate(strtotime('first day of', mktime(0, 0, 0, $this->month, 1, $this->year)));
        $this->day_of_week = $this->date_info['wday'];


        //
        $this->kate_info =  getdate(strtotime('first day of', mktime(0, 0, 0, $this->month, 10, $this->year)));
        $this->all_current_day_info = array();

        //

      


     

    }

    public function show()
    {
        $output = '<table class="calender">';

        $output .= '<caption>' . $this->date_info['month'] . '' . $this->year . '</caption>';

        $output .= '<tr>';


        //Days of the week header with day names

        foreach ($this->days_of_week as $day) {

            $output .= '<th class="header">' . $day . '</th>';
        }

        //Close header row and open first row of original days

        $output .= '</tr><tr>';

        //if first day of month deos not fall on a sunday, then we need to fill beginning space using colspan
        //assiging the correct position of the date in context of week day 
        //starting the calender
        if ($this->day_of_week > 0) {
            $output .= '<td colspan="' . $this->day_of_week . '"> </td>';
        }

        //start num_days counter , date counter of the month

        $current_day = 1;

        //looping and buiding days

        while ($current_day <= $this->num_days) {

            ////Resest days of week counter and closing each row at the end of row


            if ($this->day_of_week == 7) {
                $this->day_of_week = 0;
                $output .= '</tr><tr>';
            }


            ////Build each day

            $output .= '<td class="day">' . '<a href="show_info()">' . $current_day . '</a>' . '</td>';




            //custom script

            
            

                $ok= getdate(mktime(0,0,0, $this->month,$current_day,$this->year));
                
        
               
               
                 
                

        





            //Incrementing the current_day value

            $current_day++;

            // week day counter increments for next week positioning

            $this->day_of_week++;
            //ending while loop for generating days 
            
            //
            array_push($this->all_current_day_info,$ok);
                

        }

        // Filling the remainings day spaces of the month with colspan

        if ($this->day_of_week != 7) {

            $remaining_days = (7 - $this->day_of_week);
            $output .= '<td colspan="' . $remaining_days . '" ></td>';
        }

        //closing final row and table

        $output .= '</tr></table>';

        echo $output;


        ///custom script


        
         
        
    }

    //show all date info

    public function show_all_date_info(){

        echo '<br><h3>All Date Information of this month</h3><hr>';


        $numbering=1;

        $all = $this->all_current_day_info;

        for($i=0; $i<=count($all);$i++ ){
            echo 'Date No : <b>'.$numbering.'  '.$this->date_info['month'].', '.$this->date_info['year'].'<hr>'.'</b><br>';
            foreach($all[$i] as $j => $k){
                echo $j.'--->'.$k.'<br>';
                
            };
            echo '<hr>';
            $numbering++;
        }

     

        //echo count($all);
        //echo $all[5];
       
    }

   


    //ends

    public function show_date()
    {
        $d = $this->date_info;
        foreach ($d as $i => $v) {
            echo "key:: " . $i . "____" . "value = " . $v . "<br>";
        }
    }
    public function add_event()
    {

        $d = $this->date_info;

        echo '<b>Weekday Is:</b>' . $d['wday'] . "<br>";



        function show_event()
        {

            //violation DRY    

            $d['events'] = array(

                'Meet Saju',
                'Go Bogra',
                'Meet Ata',
                'Go Mohastan',
                'Go Khadul',
                'Go Siddipur'
            );



            $events = $d['events'];
            echo '<b>All Works of the day: </b></br>';
            foreach ($events as $event) {


                echo $event . '<br>';
            }
        }
    }

    public function show_info(){
        echo "Bye!";

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
    <form action="index.php" method="GET">
        <label for="month">Month</label>
        <input type="text" name="month">

        <label for="year">Year</label>
        <input type="text" name="year">

        <input type="submit" name="submit">
    </form>

    <?php





    if (isset($_GET['submit'])) {

        $month = $_GET['month'];
        $year = $_GET['year'];

        $calender = new Calender($month, $year);

        $calender->show();
    } else {

        $month = 3;
        $year = 2021;
        $calender = new Calender($month, $year);
        $calender->show();
    }

    //$calender->show_date();

    //$calender->add_event();

    //$calender->add_event(show_event());

    //new

    $calender->show_all_date_info();






    ?>
</body>

</html>


