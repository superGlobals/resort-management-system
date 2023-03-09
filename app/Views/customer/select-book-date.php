<?= $this->extend('layouts-customer/main') ?>

<?= $this->section('content') ?>


  <main id="main">

  <section class="ftco-section bg-light">
      <style>
       @media only screen and (max-width: 760px),
        (min-device-width: 802px) and (max-device-width: 1020px) {

            /* Force table to not be like tables anymore */
            table, thead, tbody, th, td, tr {
                display: block;

            }
            
            

            .empty {
                display: none;
            }

            /* Hide table headers (but not display: none;, for accessibility) */
            th {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            tr {
                border: 1px solid #ccc;
            }

            td {
                /* Behave  like a "row" */
                border: none;
                border-bottom: 1px solid #eee;
                position: relative;
                padding-left: 50%;
            }



            /*
		Label the data
		*/
            td:nth-of-type(1):before {
                content: "Sunday";
            }
            td:nth-of-type(2):before {
                content: "Monday";
            }
            td:nth-of-type(3):before {
                content: "Tuesday";
            }
            td:nth-of-type(4):before {
                content: "Wednesday";
            }
            td:nth-of-type(5):before {
                content: "Thursday";
            }
            td:nth-of-type(6):before {
                content: "Friday";
            }
            td:nth-of-type(7):before {
                content: "Saturday";
            }


        }

        /* Smartphones (portrait and landscape) ----------- */

        @media only screen and (min-device-width: 320px) and (max-device-width: 480px) {
            body {
                padding: 0;
                margin: 0;
            }
        }

        /* iPads (portrait and landscape) ----------- */

        @media only screen and (min-device-width: 802px) and (max-device-width: 1020px) {
            body {
                width: 495px;
            }
        }

        @media (min-width:641px) {
            table {
                table-layout: fixed;
            }
            td {
                width: 33%;
            }
        }
        
        .row{
            margin-top: 20px;
        }
        
        .today{
            background:#eee;
        }

    </style>

    <?php 

      function build_calendar($month, $year, $event = null) {
        $db = db_connect();
        $builder = $db->table('tbl_events_places');
        $builder->select('*');
        $builder->where('status', 'active');
        $event_place_res = $builder->get()->getResult();

        $builder = $db->table('tbl_events_transaction');
        $builder->select('*');
        $builder->where('MONTH(date_book)', $month);
        $builder->where('YEAR(date_book)', $year);
        $builder->where('event_place_id', $event);
        $builder->where('transaction_status !=', 'cancelled');
        // $builder->where('date_book')->limit(1);
        $bookings = $builder->get()->getResult();

        // echo "<pre>";
        // print_r($bookings);
        // die;

        if($bookings > 0)
        {
            foreach($bookings as $row)
            {
                $bookings[] = $row->date_book;
            }
        }

        
        
        $daysOfWeek = array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
        $firstDayOfMonth = mktime(0,0,0,(int)$month,1,$year);
        $numberDays = date('t',$firstDayOfMonth);
        $dateComponents = getdate($firstDayOfMonth);
        $monthName = $dateComponents['month'];
        $dayOfWeek = $dateComponents['wday'];

        $datetoday = date('Y-m-d');


    
        $calendar = "<table class='table table-bordered'>";
        $calendar .= "<center><h2>$monthName $year</h2>";
        $calendar.= " <a class='btn btn-xs btn-danger' href='?month=".date('m')."&year=".date('Y')."'>Current Month</a> ";
        $calendar.= "<a class='btn btn-xs btn-primary' href='?month=".date('m', mktime(0, 0, 0, (int)$month+1, 1, $year))."&year=".date('Y', mktime(0, 0, 0, (int)$month+1, 1, $year))."'>Next Month</a></center><br>";
        
    
        $calendar .= "<tr>";
        foreach($daysOfWeek as $day) {
            $calendar .= "<th  class='header'>$day</th>";
        } 

        $currentDay = 1;
        $calendar .= "</tr><tr>";


        if ($dayOfWeek > 0) { 
            for($k=0;$k<$dayOfWeek;$k++){
                    $calendar .= "<td  class='empty'></td>"; 

            }
        }
        
        $month = str_pad($month, 2, "0", STR_PAD_LEFT);

    
        while ($currentDay <= $numberDays) {

            if ($dayOfWeek == 7) {

                $dayOfWeek = 0;
                $calendar .= "</tr><tr>";

            }
            
            $currentDayRel = str_pad($currentDay, 2, "0", STR_PAD_LEFT);
            $date = "$year-$month-$currentDayRel";
            
                $dayname = strtolower(date('l', strtotime($date)));
                $eventNum = 0;
                $today = $date==date('Y-m-d')? "today" : "";
            if($date<date('Y-m-d')){
                $calendar.="<td><h4>$currentDay</h4> <button class='btn btn-danger btn-sm' disabled>N/A</button>";
            }elseif(in_array($date, $bookings)){
                $calendar.="<td class='$today'><h4>$currentDay</h4> <button class='btn btn-danger btn-sm'>Already Booked</button>";
            }else{
            
                $calendar.="<td class='$today'><h4>$currentDay</h4> <a href='".base_url()."/Customer/book-event/".$date."/".$event."' class='btn btn-success btn-sm'> <span class='glyphicon glyphicon-ok'></span> Book Now</a>";
            }
                
            $calendar .="</td>";
            $currentDay++;
            $dayOfWeek++;
        }

        if ($dayOfWeek != 7) { 
        
            $remainingDays = 7 - $dayOfWeek;
                for($l=0;$l<$remainingDays;$l++){
                    $calendar .= "<td class='empty'></td>"; 
            }
        }
        
        $calendar .= "</tr>";
        $calendar .= "</table>";
        echo $calendar;

    }

?>


    


    <div class="container">
      <div class="row">
        <div class="card shadow border-0">
          <div class="card-body">
            <div class="col-md-12">
              <!-- <div class="alert alert-success">
                <h3 class="text-center">Pick your booking date </h3>
              </div> -->

              <?php 
                $date_compo = getdate();
                if(isset($_GET['month']) && isset($_GET['year']))
                {
                  $month = $_GET['month'];
                  $year = $_GET['year'];
                }
                else
                {
                  $month = $date_compo['month'];
                  $year = $date_compo['year'];
                }

                $event_res = $event->id;

                echo build_calendar($month, $year, $event_res);

              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
      </section>
  

    

  </main><!-- End #main -->

  <!-- Modal -->
<div class="modal fade" id="cancellation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-4">
        <h4>Cancellation Policy</h4>
        <p>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et 
            dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip 
            ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu 
            fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt 
            mollit anim id est laborum
        </p>
      </div>
      <div class="modal-footer" style="border: none;">
        <a class="text-primary" data-bs-dismiss="modal" style="cursor: pointer;">OK</a>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="room_shutdown" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body p-4">
        <h4>Room Reservation Reminder</h4>
        <p class="text-center">
            Sorry Room Reservation is temporarily unavailable
        </p>
      </div>
      <div class="modal-footer border-0">
        <a class="text-primary" data-bs-dismiss="modal" style="cursor: pointer;">OK</a>
      </div>
    </div>
  </div>
</div>

<?= $this->endSection() ?>

  