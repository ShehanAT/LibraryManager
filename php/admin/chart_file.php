<!DOCTYPE html>  
 <html>  
      <head>  
           <title>Library Manager</title>
           <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>  
           <script type="text/javascript">  
           google.charts.load("current", {"packages": ["corechart"]});
           google.charts.setOnLoadCallback(drawChart);
           function drawChart()
           {
               var data1 = google.visualization.arrayToDataTable([
                   ["Category", "cnt"],
                   <?php 
                   while($row = mysqli_fetch_array($chart_result1))
                   {
                       echo "['" . $row["category"] . "', " .$row["cnt"]."],";
                   }
                   ?>
               ]);
               var options1 = {
                   title: "Category of books",
                   pieHole: 0.4
               };
               var chart1 = new google.visualization.PieChart(document.getElementById("piechart1"));
               chart1.draw(data1, options1);

               var data2 = google.visualization.arrayToDataTable([
                   ["UserType", "cnt"],
                   <?php 
                   while($row = mysqli_fetch_array($chart_result2))
                   {
                       echo "['" . $row["userType"] . "', " .$row["cnt"]."],";
                   }
                   ?>
               ]);
               var options2 = {
                   title: "Types of users",
                   pieHole: 0.4
               };
               var chart2 = new google.visualization.PieChart(document.getElementById("piechart2"));
               chart2.draw(data2, options2);

               var data3 = google.visualization.arrayToDataTable([
                   ["UserType", "cnt"],
                   <?php 
                   while($row = mysqli_fetch_array($chart_result3))
                   {    
                       //make query to get username
                       $user_id = $row["user_id"];
                       $query = "SELECT * FROM users WHERE user_id='$user_id' LIMIT 1";
                       $query_result = mysqli_fetch_assoc(mysqli_query($db, $query))["username"];
                       echo "['" . $query_result . "', " .$row["cnt"]."],";
                   }
                   ?>
               ]);
               var options3 = {
                   title: "All Loans by username",
                   pieHole: 0.4
               };
               var chart3 = new google.visualization.PieChart(document.getElementById("piechart3"));
               chart3.draw(data3, options3);
           }
           </script>
        </head>
        <body>
            <br /><br />
               <div style="width:100%;">
                <h3 align="center">Pie Charts of Library Statistics</h3>
                <br />
                <div id="piechart1" style="width: 450px; height: 250px;"></div>
                <div id="piechart2" style="width: 450px; height: 250px;"></div>
                <div id="piechart3" style="width: 450px; height: 250px;"></div>
            </div>
        </body>
    </html>
