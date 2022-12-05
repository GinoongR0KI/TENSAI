<?php

// Import PHP Scripts
require_once("../../functions/dbConn.php");
//

// Variables
$email = $_GET['email'];
$sel = "SELECT isActivated FROM uAccounts WHERE email = '$email';";
$selQ = $db->query($sel);

if ($selQ->num_rows > 0) {
  while ($result = $selQ->fetch_assoc()) {
    if ($result['isActivated']) {
      echo "<h1>Your account is already activated.</h1>";
      echo "<p>Please proceed to the login page.</p>";
      exit;
    }
  }
}
//

// Process

//

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="../../css/custom.min.css">
    <link rel="stylesheet" href="../../css/style.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TENSAI - Setup your account</title>
</head>
<body>
  <h1 class="text-center fs-4 mt-5">TENSAI - Setting up your account</h1>
  <form id="signUpForm" method="POST" action="setupfinish.php">
    <input type="hidden" name="uType" value="<?php echo $_GET['role']; ?>" />

    <!--Indicator-->
    <div class="form-header d-flex mb-4">
        <span class="stepIndicator">Account Setup</span>
        <span class="stepIndicator">General Information</span>
        <?php
          if (isset($_GET['role'])) {
            if ($_GET['role'] == "Student") {
              echo "<span class=\"stepIndicator\">Guardian Details</span>";
            } else if ($_GET['role'] == "Teacher") {
              echo "<span class=\"stepIndicator\">Other Information</span>";
            }
          }
        ?>
        <!-- <span class="stepIndicator">Guardian Details</span>
        <span class="stepIndicator">Other Information</span>If teacher -->
    </div>

    <!--Step 1: Account Setup-->
    <div class="step">
      <p class="text-center mb-4">Create your account</p>
      <div class="form-floating mb-3">
          <!--to be disabled-->
          <input type="email" name="email" class="form-control" id="floatingEmail" placeholder="Email" value="<?php echo isset($_GET['email']) ? $_GET['email'] : null ?>" readOnly>
          <label for="floatingEmail">Email</label>
      </div>
      <div class="form-floating mb-3">
          <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
          <label for="floatingPassword">Password</label>
      </div>
      <div class="form-floating mb-3">
          <input type="password" name="passwordConfirm" class="form-control" id="floatingPasswordConfirm" placeholder="Confirm Password">
          <label for="floatingPasswordConfirm">Confirm Password</label>
      </div>
    </div>

    <!--Step 2: General Information-->
    <div class="step">
        <p class="text-center mb-4">General Information</p>

        <div class="form-floating mb-3">
            <input class="form-control" name="fname" type="text" placeholder="First Name" id="floatingInput">
            <label for="floatingInput">First Name</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" name="mname" type="text" placeholder="Middle Name" id="floatingInput">
            <label for="floatingInput">Middle Name</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" name="lname" type="text" placeholder="Last Name" id="floatingInput">
            <label for="floatingInput">Last Name</label>
        </div>
    </div>

    <!--Step 3: Other Details--><!--Student-->
    <!-- <div class="step">
        <p class="text-center mb-4">Guardian's Details</p>

        <div class="form-floating mb-3">
            <input class="form-control" type="text" placeholder="Guardian's First Name" id="floatingInput">
            <label for="floatingInput">Guardian's First Name</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="text" placeholder="Guardian's Middle Name" id="floatingInput">
            <label for="floatingInput">Guardian's Middle Name</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="text" placeholder="Guardian's Last Name" id="floatingInput">
            <label for="floatingInput">Guardian's Last Name</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="email" placeholder="Email" id="floatingEmail">
            <label for="floatingEmail">Email</label>
        </div>
        <div class="form-floating mb-3">
            <input class="form-control" type="text" placeholder="Contact Number" id="floatingInput">
            <label for="floatingInput">Contact Number</label>
        </div>
    </div> -->

    <?php
      if (isset($_GET['role'])) {
        if ($_GET['role'] == "Student") {
          echo "
          <div class=\"step\">
            <p class=\"text-center mb-4\">Guardian's Details</p>

            <div class=\"form-floating mb-3\">
                <input name=\"gfname\" class=\"form-control\" type=\"text\" placeholder=\"Guardian's First Name\" id=\"floatingInput\">
                <label for=\"floatingInput\">Guardian's First Name</label>
            </div>
            <div class=\"form-floating mb-3\">
                <input name=\"gmname\" class=\"form-control\" type=\"text\" placeholder=\"Guardian's Middle Name\" id=\"floatingInput\">
                <label for=\"floatingInput\">Guardian's Middle Name</label>
            </div>
            <div class=\"form-floating mb-3\">
                <input name=\"glname\" class=\"form-control\" type=\"text\" placeholder=\"Guardian's Last Name\" id=\"floatingInput\">
                <label for=\"floatingInput\">Guardian's Last Name</label>
            </div>
            <div class=\"form-floating mb-3\">
                <input name=\"gemail\" class=\"form-control\" type=\"email\" placeholder=\"Email\" id=\"floatingEmail\">
                <label for=\"floatingEmail\">Email</label>
            </div>
            <div class=\"form-floating mb-3\">
                <input name=\"gcontact\" class=\"form-control\" type=\"text\" placeholder=\"Contact Number\" id=\"floatingInput\">
                <label for=\"floatingInput\">Contact Number</label>
            </div>
          </div>
          ";
        } else if ($_GET['role'] == "Teacher") {
          echo "
            <div class=\"step\">
              <p class=\"text-center mb-4\">Teacher's Details</p>
      
              <div class=\"form-floating mb-3\">
                  <input name=\"profID\" class=\"form-control\" type=\"text\" placeholder=\"Professional ID Number\" id=\"floatingInput\">
                  <label for=\"floatingInput\">Professional ID Number</label>
              </div>
            </div>
          ";
        }
      }
            
    ?>
    <!--Step 3: Other Details--><!--Teacher-->
    <!--<div class="step">
        <p class="text-center mb-4">Teacher's Details</p>

        <div class="form-floating mb-3">
            <input class="form-control" type="text" placeholder="Professional ID Number" id="floatingInput">
            <label for="floatingInput">Professional ID Number</label>
        </div>
    </div>-->
    <div class="form-footer d-flex">
        <button type="button" class="btn" id="prevBTN" onclick="nextPrev(-1)">PREVIOUS</button>
        <button type="button" class="btn btn-palette2" id="nextBTN" onclick="nextPrev(1)">NEXT</button>
    </div>
  </form>

    <script>
        var currentTab = 0; // Current tab is set to be the first tab (0)
        showTab(currentTab); // Display the current tab
        
        function showTab(n) {
          // This function will display the specified tab of the form...
          var x = document.getElementsByClassName("step");
          x[n].style.display = "block";
          //... and fix the Previous/Next buttons:
          if (n == 0) {
            document.getElementById("prevBTN").style.display = "none";
          } else {
            document.getElementById("prevBTN").style.display = "inline";
          }
          if (n == (x.length - 1)) {
            document.getElementById("nextBTN").innerHTML = "Submit";
          } else {
            document.getElementById("nextBTN").innerHTML = "Next";
          }
          //... and run a function that will display the correct step indicator:
          fixStepIndicator(n)
        }
        
        function nextPrev(n) {
          // This function will figure out which tab to display
          var x = document.getElementsByClassName("step");
          // Exit the function if any field in the current tab is invalid:
          if (n == 1 && !validateForm()) return false;
          // Hide the current tab:
          x[currentTab].style.display = "none";
          // Increase or decrease the current tab by 1:
          currentTab = currentTab + n;
          // if you have reached the end of the form...
          if (currentTab >= x.length) {
            // ... the form gets submitted:
            console.log(currentTab);
            currentTab -= 1;
            console.log(currentTab);
            // ... the form gets submitted:
            passVal = document.querySelector("#floatingPassword").value;
            passValConfirm = document.querySelector("#floatingPasswordConfirm").value;

            if (passVal == passValConfirm && passVal != "") {
              document.getElementById("signUpForm").submit();
              console.log("Submitted");

              return false;  
            } else {
              alert("Error: Your passwords do not match!");
            }
          }
          // Otherwise, display the correct tab:
          showTab(currentTab);
        }
        
        function validateForm() {
          // This function deals with validation of the form fields
          var x, y, i, valid = true;
          x = document.getElementsByClassName("step");
          y = x[currentTab].getElementsByTagName("input");
          // A loop that checks every input field in the current tab:
          for (i = 0; i < y.length; i++) {
            // If a field is empty...
            if (y[i].value == "") {
              // add an "invalid" class to the field:
              y[i].className += " invalid";
              // and set the current valid status to false
              valid = false;
            }
          }
          // If the valid status is true, mark the step as finished and valid:
          if (valid) {
            document.getElementsByClassName("stepIndicator")[currentTab].className += " finish";
          }
          return valid; // return the valid status
        }
        
        function fixStepIndicator(n) {
          // This function removes the "active" class of all steps...
          var i, x = document.getElementsByClassName("stepIndicator");
          for (i = 0; i < x.length; i++) {
            x[i].className = x[i].className.replace(" active", "");
          }
          //... and adds the "active" class on the current step:
          x[n].className += " active";
        }
    </script>


  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</body>
</html>