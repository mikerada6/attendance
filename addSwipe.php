<?php
include_once("config.php");
try{
    $_piID = $_GET['piID'];
    $_piPassword = $_GET['piPassword'];
    $_studnetId = $_GET['studnetId'];
    $timestamp = isset($_POST['timestamp']) ? $_POST['timestamp'] : date("Y-m-d H:i:s");
    
    #first check to make sure this is coming from a pi with proper credentials
    $sql="select password from RASPBERRYPI where id= :user;";
    $statement = $db -> prepare($sql);
    $statement->execute([':user' => $_piID]);
    if ($statement->rowCount() > 0){
        $check = $statement->fetch(PDO::FETCH_ASSOC);
        $row_id = $check['password'];
        $password = $check['password'];
    }
    else {
        #this happens when no such user exists.
        http_response_code(401);
        echo "error 401" . "<br>";
        $db=null;
        die("No such user");
    }
    
    if(strlen($_piPassword)>0)
    {
        if (password_verify($_piPassword,$password))
            {
            #the passwords match allow them to add the swipe
            try{
                 $sql = "INSERT INTO `SWIPE`(studentId, locationId,timestamp) VALUES (:studentId, :locationId, :timestamp);";
                 $statement = $db -> prepare($sql);
                 $statement->execute([':studentId' => $_studnetId, ':locationId' => $_piID, ':timestamp'=>$timestamp]);
                 $count  = $statement->rowCount();
                if ($count==1)
                    {
                        echo "200";
                        http_response_code(200);
                    }
                else
                {
                    http_response_code(503);
                    echo "error 503" . "<br>";
                    $db=null;
                    die("Could not insert.");
                }
            }catch(PDOException $e)
                {
                    http_response_code(503);
                    echo "error 503" . "<br>";
                    $db=null;
                    die("Could not insert.");
                }
            }   
        else {
                #passwords do not match
                http_response_code(401);
                echo "error 401" . "<br>";
                $db=null;
                die("Password incorrect");
        }
    }
    else
    {
        http_response_code(419);
        echo "error 419" . "<br>";
        $db=null;
        die("No password given.");
    }
}
catch(PDOException $e)
    {
    echo $sql . "<br>" . $e->getMessage();
    }
    $db=null;
 die();
?>