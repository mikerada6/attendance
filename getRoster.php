<?php
include_once("config.php");
$_periodId = $_GET['periodId'];
$sql ="select STUDENT.firstName as first, STUDENT.lastName as last, STUDENT.id as id from ROSTER join STUDENT on STUDENT.id=ROSTER.studentId where ROSTER.periodId=:periodId;";
try
{
    $statement = $db -> prepare($sql);
    $statement->execute([':periodId' => $_periodId]);
    $count  = $statement->rowCount();
                if ($count<1){
                    http_response_code(503);
                    $db=null;
                    die();
                }
    $resultset = $statement->fetchALL(PDO::FETCH_ASSOC);
    echo json_encode($resultset);
    http_response_code(200);
     $db=null;
    die();
    
}catch(PDOException $e)
    {
            #this happens when no such user exists.
        http_response_code(401);
        echo "error 401" . "<br>";
        $db=null;
        die("No such user");
    }
    $db=null;
http_response_code(200);
die();
?>