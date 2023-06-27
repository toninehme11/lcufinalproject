<?php 
session_start();
if(!isset($_SESSION['teacher']) || $_SESSION['teacher'] != 'yes')
{
  // Redirect if not teacher user
  echo "<script>window.location.href = '../index.php'</script>";
}else{
include "./Header.php";
?>
<!DOCTYPE html>
<html>
    <head>
    <link rel="stylesheet" type="text/css" href='./index.css'>
    <link rel="shortcut icon" href="../img/learniverselogo.ico" type="image/x-icon">

    </head>
<body style="margin-top:4rem">
<div class="message d-flex justify-content-center">
    <h4 style="color: crimson;">Important Notice: Our working hours follow Lebanese Time (GMT+3). Thank you for understanding.</h4 >
</div>
<form action="./addSchedule.php" method="post" style="margin-top:2rem">
    <table>
        <?php
            $days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
            $hours = range(0, 23);

            foreach ($days as $day) {
                echo '<tr>';
                echo '<th>'.$day.'</th>';

                foreach ($hours as $hour) {
                    $formattedHour = str_pad($hour, 2, '0', STR_PAD_LEFT) . ":00";
                    echo '<td>';
                    echo '<input type="checkbox" name="schedule[]" value="'.$day.' '.$formattedHour.'">';
                    echo $formattedHour;
                    echo '</td>';
                }

                echo '</tr>';
            }
        ?>
    </table>
    <div class="d-flex flex-row-reverse " style="height:2rem;margin-top: 1rem;">
    <input type="submit" value="Submit">
    </div>
</form>
<script>
$(document).ready(function() {
    // Call getSchedule when the page is loaded
    getSchedule();
});

function getSchedule() {
    $.ajax({
    url: './getSchedule.php', 
    type: 'POST',
    dataType: 'json',
    data: {
        teacherId: <?php echo $_SESSION['id']; ?> 
    },
    success: function(data) {
    var days = ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
    for (var i in days) {
        var day = days[i];
        if (data.hasOwnProperty(day) && data[day]) {
            var hours = data[day].split(',');
            for (var j in hours) {
                var paddedHour = ('0' + hours[j].trim()).slice(-5);
                var checkboxValue = day + ' ' + paddedHour;
                // console.log(checkboxValue);  // print the checkboxValue
                $('input[type=checkbox][value="' + checkboxValue + '"]').prop('checked', true);
            }
        }
    }
}

    });
}

</script>

</body>
</html>
 <?php       }?>