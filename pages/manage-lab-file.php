<?php
    // include "../includes/session.php";
    include "includes/config.php";
    include "includes/header.php";
?>
<style>
        @import url('/ca-dept-portal/css/css-button.css');

        table{
            width: 100%;
            text-align: center;
            /* background-color: red; */
            
        }
        th{
            /* background-color: aqua; */
            padding: 10px;
            
            /* text-align: center; */
        }
        td{
            /* background-color: orange; */
            padding: 10px;
            
        }
        table,th,td{
            border: 2px solid black;
            border-collapse: collapse;
        }
        h4{
            text-align: center;
            padding: 1rem;
        }
        .content{
            margin-top: 10rem;    
            margin-left: 20rem;        
            margin-right: 10rem;   
            margin-bottom: 5rem;    
            /* background-color: yellow;  */
            padding: 1rem;
            border: 2px solid black;
        }
        #action-btn{
            width: 4rem;
            height: 4vh;
            /* font-weight: bold; */
            font-size: 15px;
            /* padding: 1rem; */
            /* background: transparent; */
            border: none;
            border-radius: 3px;
        }

        #addBook{
            width: 5rem;
            height: 4vh;
            font-size: 15px;
            border: none;
            border-radius: 3px;
            margin-right: 11rem;
        }
        
        input[type=search]{
            height: 4vh;
            margin-bottom: 1rem;
            text-align: center;
            border: 2px solid black;
        }
        
        

        .ribbion label{
            display: inline-block;
            /* margin-right: 5rem; */
            padding: 10px;
        }
        .info{margin-bottom: 10px; padding: 5px;}
        .info span{
            display: inline-block;
            font-weight: bold;
        }
        span + span{margin-left: 19.5rem;}

    </style>
    <script>
        function addBook(){
            // alert("Inside book add");
            var startdate = document.getElementById('start-date').value;
            alert(startdate);
        }
    </script>
        <title>Manage Lab Files</title>
        <div class="content">
            <h4>INVENTORY</H4>
            <div class="ribbion">
                <form action="" method="POST">
                    <label for="">Start date</label>
                    <input id="start-date" type="date" name="start-date">
                    <label for="">TO</label>
                    <label for="">End date</label>
                    <input id="end-date" type="date" name="end-date">
                    <label for=""><input type="submit" name="search" value="Search"></label> 
                </form>
            </div>
        </div>
    <?php
?>
<?php
    if(isset($_POST['search']))
    {
        // echo "<script>alert('inside isset');</script>";
        $startdate = $_POST['start-date'];   
        $enddate = $_POST['end-date'];   

        $sql = "SELECT * FROM lab_files WHERE DATE(DATE_OF_ISSUE) BETWEEN '$startdate' AND '$enddate'";

        $result = mysqli_query($conn, $sql);
        $rows = mysqli_num_rows($result);

        $online_sql = "SELECT SUM(QUANTITY) AS totalonline FROM lab_files WHERE PAYMENT_MODE = 'online' AND DATE(DATE_OF_ISSUE) BETWEEN '$startdate' AND '$enddate'";
        $cash_sql = "SELECT SUM(QUANTITY) AS totalcash FROM lab_files WHERE PAYMENT_MODE = 'cash' AND DATE(DATE_OF_ISSUE) BETWEEN '$startdate' AND '$enddate' ";

        $online_res = mysqli_query($conn, $online_sql);
        $cash_res = mysqli_query($conn, $cash_sql);
        if($rows > 0)
        {
            ?>
                <div class="content">
                    <?php
                        $online = mysqli_fetch_assoc($online_res);
                        $cash = mysqli_fetch_assoc($cash_res);
                        $total = $online['totalonline'] + $cash['totalcash'];
                    ?>
                    <div class="info">
                        <!-- <table> -->
                            <!-- <tr> -->
                                <span><?php echo "Online: <span style='color: red;'>".$online['totalonline']."</span>"."<br>";?></span>
                                <span><?php echo "Cash: <span style='color: red;'>".$cash['totalcash']."</span>"."<br>";?></span>
                                <span><?php echo "Total: <span style='color: red;'>".$total."</span>"?></span>
                            <!-- </tr> -->
                        <!-- </table> -->
                    </div>

                    <table id="tbl-data">
                        <tr>
                            <th>DATE</th>
                            <th>REGISTRATION NUMBER</th>
                            <th>QUANTITY</th>
                            <th>PAYMENT MODE</th>
                        </tr>
                        <?php
                            while($row = mysqli_fetch_assoc($result))
                            {
                                ?>
                                <tr>
                                    <!-- <td><?php echo $i; ?></td> -->
                                    <td><?php echo $row['DATE_OF_ISSUE'];?></td>
                                    <td><?php echo $row['REG_NO'];?></td>
                                    <td><?php echo $row['QUANTITY'];?></td>
                                    <td><?php echo $row['PAYMENT_MODE'];?></td>
                                </tr>
                                <?php
                            }
                        ?>
                    </table>
                </div>
            <?php
        }
        else
        {
            echo "<script>alert('No records found')</script>";
        }
    }
?>
    