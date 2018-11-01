<?php
include_once("config.php");
$_studentId = $_GET['studentId'];
$_locationId = $_GET['locationId'];
$_piID = isset($_GET['piID']) ? $_GET['piID'] : 8218945314;
$_piPassword = isset($_GET['piPassword']) ? $_GET['piPassword'] : 'D2E5C815E2312784454BCD43BA326';
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
             //you're in
             try{
             $sql1="SELECT count(*) as swipes FROM  SWIPE  WHERE studentId= :studentId AND locationId= :locationId and Date(timestamp)=Date(now()) and TIME(timestamp)>(select lastEnd from CURRENT where id=1);";
             $statement = $db -> prepare($sql1);
             $statement->execute([':studentId' => $_studentId,':locationId' => $_locationId ]);
             $count  = $statement->rowCount();
                if ($count<1){
                    http_response_code(503);
                    $db=null;
                    die();
                }
            #$resultset = $statement->fetch(PDO::FETCH_ASSOC);
            while($record = $statement->fetch()) {
                echo $record['swipes'];
            }
            
             }
            catch(PDOException $e)
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
    
  
?>