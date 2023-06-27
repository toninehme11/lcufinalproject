<?php
session_start();
?>
<?php
if(!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] != 'YES!')
{
  // Redirect if not super user
  echo "<script>window.location.href = '../login.php'</script>";
}else{
  // Include database connection
  include '../constants/db_conn.php';
}


$teacher_id = isset($_GET['teacher_id']) ? $_GET['teacher_id'] : null;

// Get number of days in the current month
$daysInMonth = date('t');

// Get the first day of the month (0 for Sunday through 6 for Saturday)
$firstDayOfMonth = date('w', strtotime(date('Y-m-01')));

// Get today's date
$today = date('j');

function getSchedule($teacher_id, $conn) {
    $sql = "SELECT * FROM teachers_schedule WHERE userId = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $teacher_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $schedule = $result->fetch_assoc();

    return $schedule;
}

$schedule = getSchedule($teacher_id, $conn);

$days = ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday'];

function checkAppointmentExists($date, $hour, $teacherId, $conn) {
    $stmt = $conn->prepare('SELECT * FROM appointments WHERE teacher_id = ? AND date = ? AND hour = ?');
    $stmt->bind_param('iss', $teacherId, $date, $hour);
    $stmt->execute();
    $result = $stmt->get_result();
    $appointment = $result->fetch_assoc();

    return $appointment !== null;
}
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Your Session</title>
    <style>
        .calendar {
            width: 100%;
            text-align: center;
        }

        .calendar th {
            height: 50px;
            text-align: center;
        }

        .calendar td {
            width: 14.28%;
            /* 100 / 7 (because there are 7 days in a week) */
            height: 100px;
            vertical-align: middle;
            padding: 5px;
        }

        .calendar button {
            width: 70%;
            height: 70%;
            border-radius: 10px;
            font-size: 16px;
            color: #00008b;
            background: #E6E6FF;
            border: none;
            cursor: pointer;
        }

        .calendar button:hover {
            background: #C7FFD8;
        }

        .calendar .today button {
            background: #FFDCE5;
        }

        .calendar .today button:hover {
            background: #ffa8be;
        }
    </style>
    <script>
        var days = <?php echo json_encode($days); ?>;
    </script>
    <?php include './Header.php' ?>
</head>

<body style="margin-top:4rem;">
    <h4 class="d-flex justify-content-center" style="color: crimson;">Important Notice: Our working hours follow Lebanese Time (GMT+3). Thank you for understanding.</h4>

    <h1 class="d-flex justify-content-center"><?php echo date('F'); ?></h1>

    <table class="calendar">
        <tr>
            <th>Sun</th>
            <th>Mon</th>
            <th>Tue</th>
            <th>Wed</th>
            <th>Thu</th>
            <th>Fri</th>
            <th>Sat</th>
        </tr>
        <tr>
            <?php
            // Print empty cells up until the first day of the month
            for ($i = 0; $i < $firstDayOfMonth; $i++) {
                echo "<td></td>";
            }

            // Print days of the month
            for ($day = 1; $day <= $daysInMonth; $day++) {
                if (($day + $firstDayOfMonth - 1) % 7 == 0 && $day != 1) {
                    echo "</tr><tr>";
                }

                $isToday = $day == $today ? 'today' : '';

                // If it's a day before today, add a 'disabled' class
                if ($day < $today) {
                    echo "<td class=\"day $isToday\"><button onclick=\"oldday()\">$day</button></td>";
                } else {
                    echo "<td class=\"day $isToday\"><button onclick=\"book($day, $teacher_id)\">$day</button></td>";
                }
            }

            // Print empty cells after the last day of the month
            while (($day + $firstDayOfMonth - 1) % 7 != 0) {
                echo "<td></td>";
                $day++;
            }
            ?>
        </tr>
    </table>

    <div class="mt-5 mb-5" id="schedule"></div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script>
        function oldday(){
            Swal.fire({
        icon: 'warning',
        title: 'That Is An Old Day Of The Week',
        text: 'Please Select Another Day',
        denyButtonText: `Ok`,

      })
        }

        function getCardType(number) {
            number = number.replace(/\D/g, '');
            let cards = {
                VISA: /^4[0-9]{12}(?:[0-9]{3})?$/,
                MASTER: /^5[1-5][0-9]{14}$/,
                AEXPRESS: /^3[47][0-9]{13}$/,
                DINERS: /^3(?:0[0-5]|[68][0-9])[0-9]{11}$/,
                DISCOVERS: /^6(?:011|5[0-9]{2})[0-9]{12}$/,
                JCB: /^(?:2131|1800|35\d{3})\d{11}$/,
                BCGLOBAL: /^(6541|6556)[0-9]{12}$/,
                INSTAPAYMENT: /^63[7-9][0-9]{13}$/,
                CARTEBLANCHE: /^389[0-9]{11}$/,
                KOREANLOCAL: /^9[0-9]{15}$/,
                LASER: /^(6304|6706|6709|6771)[0-9]{12,15}$/,
                MAESTRO: /^(5018|5020|5038|6304|6759|6761|6763)[0-9]{8,15}$/,
                SOLO: /^(6334|6767)[0-9]{12}|(6334|6767)[0-9]{14}|(6334|6767)[0-9]{15}$/,
                SWITCH: /^(4903|4905|4911|4936|6333|6759)[0-9]{12}|(4903|4905|4911|4936|6333|6759)[0-9]{14}|(4903|4905|4911|4936|6333|6759)[0-9]{15}|564182[0-9]{10}|564182[0-9]{12}|564182[0-9]{13}|633110[0-9]{10}|633110[0-9]{12}|633110[0-9]{13}$/,
                UNIONPAY: /^(62[0-9]{14,17})$/,
                VISAMASTER: /^(?:4[0-9]{12}(?:[0-9]{3})?|5[1-5][0-9]{14})$/
            };
            var invalid = false;
            for (var card in cards) {
                if (cards[card].test(number)) {
                    console.log(card)
                    return card;
                } else {
                    invalid = true;
                }
            }
            if (invalid) return 0;
        }

        function validateEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }

        function book(day, teacher_id) {
            var date = new Date();
            date.setDate(day);
            var dayOfWeek = days[date.getDay()];

            var xhr = new XMLHttpRequest();
            xhr.open('GET', 'getSchedule.php?teacher_id=' + teacher_id + '&day=' + dayOfWeek, true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    var result = JSON.parse(xhr.responseText);
                    var hours = result[dayOfWeek];
                    // Get the schedule div
                    var scheduleDiv = document.getElementById('schedule');

                    // Clear existing buttons
                    while (scheduleDiv.firstChild) {
                        scheduleDiv.removeChild(scheduleDiv.firstChild);
                    }

                    // Style the scheduleDiv to center the buttons
                    scheduleDiv.style.display = 'flex';
                    scheduleDiv.style.flexDirection = 'row';
                    scheduleDiv.style.flexWrap = 'wrap';
                    scheduleDiv.style.justifyContent = 'center';
                    scheduleDiv.style.alignItems = 'center';

                    // Add a title for the schedule
                    var title = document.createElement('h2');
                    title.textContent = "Available hours on " + dayOfWeek + " (" + day + "):";
                    title.style.width = '100%'; // Make the title span the entire width
                    title.style.textAlign = 'center'; // Center the text within the title
                    scheduleDiv.appendChild(title);

                    if (hours) {
                        hours = hours.split(",");

                        // Create a button for each available hour
                        hours.forEach(function(hour) {
                            var button = document.createElement('button');
                            button.textContent = hour;
                            button.style.width = '10%';
                            button.style.height = '70px';
                            button.style.margin = '4px 30px';
                            button.style.borderRadius = '10px';
                            button.style.fontSize = '16px';
                            button.style.color = '#00008b';
                            button.style.background = '#E6E6FF';
                            button.style.border = 'none';
                            button.style.cursor = 'pointer';
                            // Hover effect
                            button.onmouseover = function() {
                                button.style.background = '#C7FFD8';
                            }
                            button.onmouseout = function() {
                                button.style.background = '#E6E6FF';
                            }
                            var appointmentDate = new Date(date.getFullYear(), date.getMonth(), day, hour.split(':')[0]);
                            // Make an AJAX request to check if the appointment exists
                            var checkAppointmentExists = new XMLHttpRequest();
                            checkAppointmentExists.open('GET', 'checkAppointmentExists.php?teacherId=' + teacher_id + '&date=' + appointmentDate.toISOString().split('T')[0] + '&hour=' + hour, true);
                            checkAppointmentExists.onreadystatechange = function() {
                                if (checkAppointmentExists.readyState == 4 && checkAppointmentExists.status == 200) {
                                    var response = JSON.parse(checkAppointmentExists.responseText);
                                    if (response.exists) {
                                        button.disabled = true;
                                        button.style.background = '#ccc';
                                        button.style.cursor = 'not-allowed';
                                    }
                                }
                            }
                            checkAppointmentExists.send();

                            // Add click event to display the SweetAlert modal
                            button.onclick = function() {
                                Swal.fire({
                                    title: 'Book An Appointment',
                                    html: '<p style="color:crimson">!No Cancelation - No Refunds!</p><br>' +
                                          '<input class="form-control" type="text" name="name" id="name" placeholder="Name" required /><br>' +
                                          '<input class="form-control" type="email" name="email" id="email" placeholder="Email" required /><br>' +
                                          '<input class="form-control" type="tel" name="phone" id="phone" placeholder="Phone Number" required /><br>' +
                                          '<input id="ccn" class="form-control" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="19" placeholder="Credit Card : xxxx-xxxx-xxxx-xxxx" required>',
                                    showCancelButton: true,
                                    showDenyButton: true,
                                    confirmButtonText: 'Check Out',
                                    denyButtonText: 'Check supported cards',
                                    showLoaderOnConfirm: true,
                                    preConfirm: function() {
                                        var name = document.getElementById('name').value;
                                        var email = document.getElementById('email').value;
                                        var phone = document.getElementById('phone').value;
                                        var ccn = document.getElementById('ccn').value;
                                        if (!name || !email || !phone || !ccn) {
                                            Swal.showValidationMessage('Please fill all the fields.')
                                            return false; // prevent the SweetAlert modal from closing
                                        } else {
                                            // Make an AJAX request to bookAppointment.php
                                            $.ajax({
                                                url: 'bookAppointment.php',
                                                method: 'POST',
                                                data: {
                                                    teacher_id: teacher_id,
                                                    date: date.toISOString().split('T')[0],
                                                    hour: hour,
                                                    name: name,
                                                    email: email,
                                                    phone: phone,
                                                    ccn: ccn
                                                },
                                                success: function(response) {
                                                    console.log(response); // Log the response to the console

                                                    var result = JSON.parse(response);
                                                    if (result.success) {
                                                        // Booking successful, disable the button
                                                        button.disabled = true;
                                                        Swal.fire('Success', 'Appointment booked successfully!', 'success');
                                                    } else {
                                                        // Booking failed, display an error message
                                                        Swal.fire('Error', result.error, 'error');
                                                    }
                                                },
                                                error: function(xhr, status, error) {
                                                    Swal.fire('Error', 'Failed to book appointment. Please try again.', 'error');
                                                }
                                            });
                                        }
                                    },
                                    allowOutsideClick: function() {
                                        return !Swal.isLoading();
                                    }
                                }).then(function(result) {
                                    if (result.isDenied) {
                                        Swal.fire({
                                            html: '<image class="creditCards" src="../img/creditCards.jpg"></image>',
                                            confirmButtonText: 'Get back',
                                        }).then(function(result) {
                                            if (result.isConfirmed) {
                                                $('#checkout').click();
                                            }
                                        })
                                    }
                                })
                            }
                            scheduleDiv.appendChild(button);
                        });

                    } else {
                        var noHoursText = document.createElement('p');
                        noHoursText.textContent = "No available hours on this day.";
                        noHoursText.style.width = '100%'; // Make the text span the entire width
                        noHoursText.style.textAlign = 'center'; // Center the text within the text element
                        scheduleDiv.appendChild(noHoursText);
                    }
                } else if (xhr.readyState == 4) {
                    console.log("AJAX request failed. Status: ", xhr.status, "Response: ", xhr.responseText);
                    alert("Error getting schedule.");
                }
            }
            xhr.send();
        }
    </script>

    <?php include './Footer.php' ?>
</body>

</html>
