<?php 
session_start(); 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="services.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <link rel="shortcut icon" href="./img/learniverselogo.ico" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Learniverse Prices</title>
</head>

<body>
<?php include "header.php"; ?>
<br>

<div class="image">
    <div class="bg-color"></div>
    <p>Our <span><b>Prices</b></span></p>
</div>
<div class="aboutprice pb-5">
  <br>
  <h2>Professional tutoring packages for valuable prices.</h2>
  <span class='bar' style='background:#8a35e5;
    height: 1px;
    width: 90px;
    margin: 20px auto;'></span>
  <h4>We offer personalized packages that cater to your learning needs, ensuring exceptional value for every student.</h4>
  <a class="btn-pricing btn" onclick="location.href='#ourprice'">LEARN MORE</a>
</div>

<div id="ourprice" class="ourprice">
<div class="offer d-flex justify-content-center align-items-center flex-column"
    style="color:#03144f;">

    <h1><span class='offer-title' style="">Our</span> <b>Prices</b></h1>
    <span class='bar' style='background:#8a35e5 ;
  height: 1px;
  width: 90px;
  margin: 20px auto;'></span>
<h4>Starting from $11 an hour for online sessions
Expert tutors with 5+ years of experience are available starting $20</h4>
  </div>
</div>
<br>
<div class="card">
  <div class="header">
  <h2>Pricing Packages</h2>
  </div>
  <ul>
    <li>
      <span>4 hour package:</span>
      <span>$14.5/hour</span>
    </li>
    <li>
      <span>10 hour package:</span>
      <span>$13/hour</span>
    </li>
    <li>
      <span>22 hour package:</span>
      <span>$12/hour</span>
    </li>
    <li>
      <span>40+ hour package:</span>
      <span> $11.5/hour</span>
    </li>
  </ul>
  <button id="checkout" class="button">GET A SESSION</button>
</div>

<section class="improvement-section">
<div class="offer d-flex justify-content-center align-items-center flex-column"
    style="color:#03144f;">

    <h1><span class='offer-title' style="font-weight:100;">What to</span> <b>expect</b></h1>
    <span class='bar' style='background:#8a35e5;
  height: 1px;
  width: 90px;
  margin: 20px auto;'></span>
  <div class="expectations">
    <div class="improvement">
      <p><strong>At least 30% improvement</strong> after the 6 sessions</p>
    </div>
    <div class="plan">
      <p><strong>Personalized learning plan</strong> for your child's learning needs</p>
    </div>
    <div class="consultant">
      <p><strong>Dedicated educational consultant</strong> to answer all your concerns</p>
    </div>
  </div>
</section>

<?php include './Footer.php'?>
</body>
<script>
            $('#checkout').click(function(){
                Swal.fire({
                            title: 'Check Out',
                            html: '<input class="form-control" type="text" name="name" id="name" placeholder="Name" /><br>'+
                            '<input class="form-control" type="email" name="email" id="email" placeholder="Email" /><br>'+
                            '<input id="ccn" class="form-control" type="tel" inputmode="numeric" pattern="[0-9\s]{13,19}" autocomplete="cc-number" maxlength="19" placeholder="Credit Card : xxxx-xxxx-xxxx-xxxx">',
                            showCancelButton: true,
                            showDenyButton: true,
                            confirmButtonText: 'Check Out',
                            denyButtonText: 'Check supported cards',
                            showLoaderOnConfirm: true,
                            preConfirm: () => {
                                loginerror = 0;
                                if (!validateEmail($('#email').val())) {
                                    loginerror = 'Please enter a valid email address'
                                }
                                if ($('#email').val() == '' ) {
                                    loginerror = 'Email is empty. Please enter your email address.'
                                }
                                if ($('#name').val() == '') {
                                    loginerror = 'Name is empty. Please enter your name.'
                                }
                                if ($('#ccn').val() == '') {
                                    loginerror = 'Card number is empty. Please enter your card.'
                                }
                                else
                                {
                                    if (getCardType($('#ccn').val()) == 0) {
                                        loginerror = 'Card type is invalid'
                                    }
                                }
                                    
                                if(loginerror != 0)
                                {
                                    Swal.showValidationMessage(
                                    loginerror
                                    )
                                }
                            },
                            allowOutsideClick: () => !Swal.isLoading()
                            }).then((result) => {
                            if (result.isConfirmed) {

                            }
                            if (result.isDenied)
                            {
                                Swal.fire({
                                html: '<image class="creditCards" src="./img/creditCards.jpg"></image>',
                                confirmButtonText: 'Get back',
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        $('#checkout').click();
                                    }
                                })



                            }   
                            })    
            })
            
            function getCardType(number) 
            {
                    number =  number.replace(/\D/g, '');
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
                    if(invalid) return 0;
            }

            function validateEmail(email) 
                {
                    var re = /\S+@\S+\.\S+/;
                    return re.test(email);
                }
        </script>
        
</html>

