<?php  
  session_start();
    if ($_SESSION['acct_type'] == "Admin") {
    header("Location:../../Accounts/Admin");

    } elseif ($_SESSION['acct_type'] == "Department") {      
        header("Location:../../Accounts/Department");

    } elseif ($_SESSION['acct_type'] == "Driver") {
      header("Location:../../Accounts/Driver");

    } elseif ($_SESSION['acct_type'] == "Manager") {
      header("Location:../../Accounts/Manager");                 
    } 
    elseif ($_SESSION['acct_type'] == "passenger") {
      header("Location:../../Accounts/passenger");                  
    } 
    elseif ($_SESSION['acct_type'] == "security") {
      header("Location:../../Accounts/security");                
    } 
?>