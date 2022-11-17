<?php

class manageSB {

    // Variables
    
    //

    // Built-in Functions
    function __construct() {

    }
    //

    // Custom Functions
    function loadRoles() {
        if (isset($_SESSION['uType'])) {
            $uType = $_SESSION['uType'];
            switch ($uType) {
                case "Admin":
                    echo "<option value='Principal'>Principal</option>";
                break;
                case "Principal":
                    echo "<option value='Teacher'>Teacher</option>";
                break;
                case "Teacher":
                    echo "<option value='Student'>Student</option>";
                break;
            }
        }
    }
    //

}