
<?php
    session_start();
    
    {
     
            $pass_name=$_POST['pass_name'];
            //$pass_lname = $_POST['pass_lname'];
            //$pass_phone=$_POST['pass_phone'];
            $pass_addr=$_POST['pass_addr'];
            $pass_email=$_POST['pass_email'];        
            $train_no = $_POST['train_no'];
            $train_dep_stat = $_POST['train_dep_stat'];
            $train_arr_stat = $_POST['train_arr_stat'];
            $train_fare = $_POST['train_fare'];
            $train_class_type = $_POST['train_class_type'];
            $train_passenger_type = $_POST['train_passenger_type'];
            $fare_payment_code = $_POST['fare_payment_code'];
            $card_number = $_POST['card_number'];
            $expiry_date = $_POST['expiry_date'];
            $cvv = $_POST['cvv'];
        
            // SQL Query to Insert Data
            $query = "INSERT INTO orrs_train_tickets 
                      (pass_name, pass_addr, pass_email, train_no, train_dep_stat, train_arr_stat, train_class_type, train_passenger_type, train_fare, fare_payment_code, card_number, expiry_date, cvv)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
            // Prepare and Execute the Query
            $stmt = $mysqli->prepare($query);
            $stmt->bind_param('sssssssssssss', 
                $pass_name, 
                $pass_addr, 
                $pass_email, 
                $train_no, 
                $train_dep_stat, 
                $train_arr_stat, 
                $train_fare, 
                $train_class_type,
                $train_passenger_type,
                $fare_payment_code, 
                $card_number,
                $expiry_date,
                $cvv
            );
        
            if($stmt->execute()) {
                echo "<script>alert('Ticket Payment Confirmed');</script>";
            } else {
                echo "<script>alert('Error! Please Try Again');</script>";
            }
        }
        ?>
<!DOCTYPE html>
<html lang="en">
<!--Head-->
<?php include('assets/inc/head.php');?>
<!--End Head-->
  <body>
    <div class="be-wrapper be-fixed-sidebar ">
    <!--Navigation Bar-->
      <?php include('assets/inc/navbar.php');?>
      <!--End Navigation Bar-->
    <!--Log on to codeastro.com for more projects!-->
      <!--Sidebar-->
      <?php include('assets/inc/sidebar.php');?>
      <!--End Sidebar-->
      <div class="be-content">
        <div class="page-head">
          <h2 class="page-head-title">Train Ticket Checkout </h2>
          <nav aria-label="breadcrumb" role="navigation">
            <ol class="breadcrumb page-head-nav">
              <li class="breadcrumb-item"><a href="pass-dashboard.php">Dashboard</a></li>
              <li class="breadcrumb-item"><a href="#">Tickets</a></li>
              <li class="breadcrumb-item"><a href="#">Checkout</a></li>
            </ol>
          </nav>
        </div>
            <?php if(isset($succ)) {?>
                                <!--This code for injecting an alert-->
                <script>
                            setTimeout(function () 
                            { 
                                swal("Success!","<?php echo $succ;?>!","success");
                            },
                                100);
                </script>

        <?php } ?>
        <?php if(isset($err)) {?>
        <!--This code for injecting an alert-->
                <script>
                            setTimeout(function () 
                            { 
                                swal("Failed!","<?php echo $err;?>!","Failed");
                            },
                                100);
                </script>

        <?php } ?>
        <div class="main-content container-fluid">
        <?php
            $aid=$_SESSION['pass_id'];
            $ret="SELECT pass_fname, pass_lname, pass_email, pass_addr, pass_train_number, pass_dep_station, pass_arr_station, pass_train_class, pass_type, pass_train_fare, pass_fare_payment_code FROM orrs_passenger WHERE pass_id = ?";
            $stmt = $mysqli->prepare($ret);
$stmt->bind_param('i', $aid);
$stmt->execute();
$res = $stmt->get_result();

            //$cnt=1;
            while($row=$res->fetch_object())
        {
        ?>
          <div class="row">
            <div class="col-md-12">
              <div class="card card-border-color card-border-color-success">
                <div class="card-header card-header-divider"><span class="card-subtitle"></span></div>
                <div class="card-body">
                  <form method ="POST" onsubmit="return validatePaymentForm()">
                    <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3"> Name</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control" readonly name="pass_name"  value="<?php echo $row->pass_fname;?> <?php echo $row->pass_lname;?>" id="inputText3" type="text">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3"> Email</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control" readonly name="pass_email"  value="<?php echo $row->pass_email;?>" id="inputText3" type="text">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3"> Address</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control" readonly name= "pass_addr"  value="<?php echo $row->pass_addr;?>" id="inputText3" type="text">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Booked Train Number</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control" readonly name="train_no"  value="<?php echo $row->pass_train_number;?>" id="inputText3" type="text">
                      </div>
                    </div>
                   
                    <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3"> Departure </label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control" readonly  name = "train_dep_stat" value="<?php echo $row->pass_dep_station;?>" id="inputText3" type="text">
                      </div>
                    </div>
                    <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3"> Arrival </label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control" readonly name = "train_arr_stat" value="<?php echo $row->pass_arr_station;?>" id="inputText3" type="text">
                      </div>
                    </div>
                    <div class="form-group row">
  <label class="col-12 col-sm-3 col-form-label text-sm-right" for="pass_type">Passenger Type</label>
  <div class="col-12 col-sm-8 col-lg-6">
    <input class="form-control" readonly name = "train_class_type" value="<?php echo $row->pass_type;?>" id="inputText3" type="text">
  </div>
</div>

<div class="form-group row">
  <label class="col-12 col-sm-3 col-form-label text-sm-right" for="pass_train_class">Class Type</label>
  <div class="col-12 col-sm-8 col-lg-6">
    <input class="form-control" readonly name = "train_passenger_type" value="<?php echo $row->pass_train_class;?>" id="inputText3" type="text">
  </div>
</div>
                    <div class="form-group row">
        <label class="col-12 col-sm-3 col-form-label text-sm-right">Select Payment Method</label>
        <div class="col-12 col-sm-8 col-lg-6">
            <select class="form-control" name="payment_method" required>
                <option value="">-- Select Payment Method --</option>
                <option value="Credit Card">Credit Card</option>
                <option value="Debit Card">Debit Card</option>
                <option value="UPI">UPI</option>
                <option value="Net Banking">Net Banking</option>
            </select>
        </div>
    </div>
    <div class="form-group row">
        <label class="col-12 col-sm-3 col-form-label text-sm-right">Card Number</label>
        <div class="col-12 col-sm-8 col-lg-6">
            <input class="form-control" id="card_number" name="card_number" placeholder="Enter 16-digit Card Number" type="text" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-12 col-sm-3 col-form-label text-sm-right">Expiry Date</label>
        <div class="col-12 col-sm-8 col-lg-6">
            <input class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" type="text" required>
        </div>
    </div>

    <div class="form-group row">
        <label class="col-12 col-sm-3 col-form-label text-sm-right">CVV</label>
        <div class="col-12 col-sm-8 col-lg-6">
            <input class="form-control" id="cvv" name="cvv" placeholder="3-digit CVV" type="password" required>
        </div>
    </div>
                    <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Train Fare</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control" readonly name = "train_fare"  value="<?php echo $row->pass_train_fare;?>" id="inputText3" type="text">
                      </div>
                    </div>
                   

                    <div class="form-group row">
                      <label class="col-12 col-sm-3 col-form-label text-sm-right" for="inputText3">Payment Code</label>
                      <div class="col-12 col-sm-8 col-lg-6">
                        <input class="form-control"  name ="fare_payment_code" value = "<?php echo $row->pass_fare_payment_code;?>" name= "pass_fare_payment_code"  id="inputText3" type="text">
                      </div>
                    </div>

                    <div class="col-sm-6">
                        <p class="text-right">
                          <input class="btn btn-space btn-success" value ="Confirm Payment" name = "train_fare_confirm_checkout" type="submit">
                          <button class="btn btn-space btn-secondary">Cancel</button>
                        </p>
                    </div>
                  </form>
                </div>
              </div>
            </div>
       
        <?php }?>
        
        </div>
        <!--footer-->
        <?php include('assets/inc/footer.php');?>
        <!--EndFooter-->
      </div>

    </div>
    <script src="assets/lib/jquery/jquery.min.js" type="text/javascript"></script>
    <script src="assets/lib/perfect-scrollbar/js/perfect-scrollbar.min.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap/dist/js/bootstrap.bundle.min.js" type="text/javascript"></script>
    <script src="assets/js/app.js" type="text/javascript"></script>
    <script src="assets/lib/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
    <script src="assets/lib/jquery.nestable/jquery.nestable.js" type="text/javascript"></script>
    <script src="assets/lib/moment.js/min/moment.min.js" type="text/javascript"></script>
    <script src="assets/lib/datetimepicker/js/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
    <script src="assets/lib/select2/js/select2.min.js" type="text/javascript"></script>
    <script src="assets/lib/select2/js/select2.full.min.js" type="text/javascript"></script>
    <script src="assets/lib/bootstrap-slider/bootstrap-slider.min.js" type="text/javascript"></script>
    <script src="assets/lib/bs-custom-file-input/bs-custom-file-input.js" type="text/javascript"></script>
    <script type="text/javascript">
      $(document).ready(function(){
        //-initialize the javascript
        App.init();
        App.formElements();
      });
    </script>
    <script>
function validatePaymentForm() {
    const cardNumber = document.getElementById('card_number').value.trim();
    const expiryDate = document.getElementById('expiry_date').value.trim();
    const cvv = document.getElementById('cvv').value.trim();

    // Card Number Validation (16 digits)
    const cardNumberRegex = /^[0-9]{16}$/;
    if (!cardNumberRegex.test(cardNumber)) {
        alert("Invalid Card Number. Please enter a 16-digit number.");
        return false;
    }

    // Expiry Date Validation (MM/YY format)
    const expiryDateRegex = /^(0[1-9]|1[0-2])\/[0-9]{2}$/;
    if (!expiryDateRegex.test(expiryDate)) {
        alert("Invalid Expiry Date. Use MM/YY format.");
        return false;
    }

    // Expiry Date Logic Check (Not Expired)
    const currentDate = new Date();
    const [expMonth, expYear] = expiryDate.split('/').map(Number);
    const expFullYear = 2000 + expYear; // Assume years are in 20XX format
    if (expFullYear < currentDate.getFullYear() || 
        (expFullYear === currentDate.getFullYear() && expMonth < currentDate.getMonth() + 1)) {
        alert("Card Expiry Date is invalid or expired.");
        return false;
    }

    // CVV Validation (3 digits)
    const cvvRegex = /^[0-9]{3}$/;
    if (!cvvRegex.test(cvv)) {
        alert("Invalid CVV. Please enter a 3-digit CVV.");
        return false;
    }

    return true; // Form submission continues if all checks pass
}
</script>

  </body>

</html>