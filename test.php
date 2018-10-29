<?php
$school = isset($_POST['school']) ? $_POST['school'] : 1;
$teacher = isset($_POST['teacher']) ? $_POST['teacher'] : 1;
$periodId="99";
$className="ALGEBRA II";
?>
<html>
<head>
    <title>Countdown TEST page </title>
    <style>
table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
}
th, td {
    padding: 5px;
    text-align: left;    
}
</style>
</head>

<body>
    <div style="background-color:lightblue">
        <h1 id="class">
    </div>
    <div>
        <h2 id="time">
    </div>
     <div>
        <h3 id="test">
    </div>
    <div>
        <h4 id="rad">
    </div>
    
    
    <table style="width:100%" id="roster"  border: 1px solid black;>
  <tr border: 1px solid black;>
    <th>Name</th>
    <th>Attendance</th> 
    <th>Leave</th>
  </tr>
</table>

<script>


document.getElementById("class").innerHTML ="<?php echo $className;?>";
var url = "getRoster.php";
var params = "periodId="+"<?php echo $periodId; ?>";
var http = new XMLHttpRequest();
var red = '#f44242';
var yellow ='#F4D03F';
var green = '#00FF00';
var textTemp ="";
var nRequest = new Array();
http.open("GET", url+"?"+params, true);
document.getElementById("test").innerHTML =params;
http.onreadystatechange = function() 
    {
        //Call a function when the state changes.
        if(http.readyState == 4 && http.status == 200) 
        {
            var temp=http.response;
            var jsonData = JSON.parse(temp);
            var table = document.getElementById("roster");
            
            for (var i = 0; i < jsonData.length; i++) 
            {
                //Add the first and last name to the left most column of the table
                var row = table.insertRow(-1);
                
                var cell1 = row.insertCell(0);
                var cell2 = row.insertCell(1);
                cell1.innerHTML = jsonData[i].first + " " + jsonData[i].last;
                
                //create a button that will allow you to mark the student as present
                var btn1 = document.createElement("button");
                btn1.type = "button";
                btn1.className = "btn";
                btn1.innerHTML = "Present";
                var entry = jsonData[i].id;
                row.id=entry;
                
                var btn2 = document.createElement("button");
                btn2.type = "button";
                btn2.className = "btn";
                btn2.innerHTML = "Absent";
                
                
                
                //set up the background color based on the number of swipes
                //0 means students has never checked in today and is absent
                //>0 and Odd means the student is in the room
                //>0 and Even means the student is currently out of the room
                (function changeRowColor(row,entry,i){
                    
                    nRequest[i]=new XMLHttpRequest();
                    var getSwipeURl = "getSwipeCount.php";
                    var getSwipeparams = "piID=8218945314&piPassword=D2E5C815E2312784454BCD43BA326&studentId="+entry+"&locationId=8218945314";
                    
                    nRequest[i].open("GET", getSwipeURl+"?"+getSwipeparams, true);
                    textTemp+=entry;
                    
                    nRequest[i].onreadystatechange = function (oEvent) 
                        {
                            if(nRequest[i].readyState == 4 && nRequest[i].status == 200) 
                            {
                                var swipes = nRequest[i].responseText;
                                
                                if (swipes==0)
                                {
                                    row.bgColor = red;
                                }
                                else
                                {
                                    if(swipes%2==0)
                                    {
                                        row.bgColor = yellow;
                                    }
                                    else
                                    {
                                         row.bgColor = green;
                                    }
                                }
                            }
                            else
                            {
                                
                            }
                        };
                nRequest[i].send(null);
                })(row,entry,i);
                
                
                //Rig up the present button
                btn1.onclick = (function(entry) 
                {
                    
                    return function() 
                    {
                        var url1 = "addSwipe.php";
                        var params1 = "piID=8218945314&piPassword=D2E5C815E2312784454BCD43BA326&studnetId="+entry;
                        var http1 = new XMLHttpRequest();
                        http1.open("GET", url1+"?"+params1, true);
                        http1.onreadystatechange = function() 
                        {
                            if(http1.readyState == 4 && http1.status == 200) 
                            {
                             document.getElementById("test").innerHTML = entry + "id has swiped in ";
                             document.getElementById(entry).bgColor = green;
                            }
                        };
                        http1.send(null);
                        document.getElementById("test").innerHTML =entry;
                    };
                    
                })(entry);
                
                //Rig up the absent button.  All this does is change the background to yellow
                btn2.onclick = (function(entry) 
                {
                    
                    return function() 
                    {
                             document.getElementById(entry).bgColor = yellow;
                    };
                })(entry);
                
                
            cell2.appendChild(btn1);
            cell2.appendChild(btn2);
            }
        }
    };
    http.send(null);
</script>
</body>

</html>