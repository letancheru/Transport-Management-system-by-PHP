<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {      

        $username = $_POST['username'];
        $username = htmlspecialchars($username);          
        $username = mysql_real_escape_string($username);
        $password = MD5($_POST['password']);

        mysql_connect("localhost", "root", "") or die("Error connecting to database: ".mysql_error());     
        mysql_select_db("huvmts") or die(mysql_error());
        $raw_results2 = mysql_query("SELECT * FROM Account
            WHERE (`username` = '$username') AND (`password` = '$password')")or die(mysql_error());
        if(mysql_num_rows($raw_results2) == 1){
            $results = mysql_fetch_array($raw_results2);
            $_SESSION['firstname'] = $results['firstname'];
            $_SESSION['lastname'] = $results['lastname'];
            $_SESSION['email'] = $results['email'];
            $_SESSION['birthday'] = $results['birthday'];
            $_SESSION['sex'] = $results['sex'];
            $_SESSION['username'] = $results['username'];
            $_SESSION['password'] = $results['password'];
            $_SESSION['acct_type'] = $results['acct_type'];
            $_SESSION['recovery_question'] = $results['recovery_question'];
            $_SESSION['recovery_answer'] = $results['recovery_answer'];
            $_SESSION['profilepicture'] = $results['profilepicture'];
            
            if ($_SESSION['acct_type'] == "Admin") {
                header("Location:../Accounts/Admin");

            }
           

            elseif ($_SESSION['acct_type'] == "Department") {                
                $raw_results = mysql_query("SELECT * FROM `Department` WHERE (`username` = '".$_SESSION['username']."')")or die(mysql_error());
                if(mysql_num_rows($raw_results) == 1){
                    header("Location:../Accounts/Department");                    
                }else{
                    header("Location:../Accounts/Department/additional info.php");                     
                }

            } elseif ($_SESSION['acct_type'] == "Driver") {  
                $raws = mysql_query("SELECT * FROM `Driver` WHERE (`username` = '".$_SESSION['username']."')")or die(mysql_error());
                if(mysql_num_rows($raws) == 1){
                    header("Location:../Accounts/Driver");                    
                }else{
                    header("Location:../Accounts/Driver/additional info.php");                     
                }                
            } elseif ($_SESSION['acct_type'] == "Manager") {
                header("Location:../Accounts/Manager");
                
            } 
            elseif ($_SESSION['acct_type'] == "Passenger") {
                header("Location:../Accounts/passenger");
                
            } elseif ($_SESSION['acct_type'] == "Security") {
                header("Location:../Accounts/security");
                
            } 
        }else{
            echo '<script type="text/javascript">window.alert("'.'Please Enter correct username and/or password'.'");</script>';
        }
    }
?>