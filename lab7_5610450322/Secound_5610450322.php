<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!--5610450322 ข้อ 22-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style>
            #table {
                width:75%;
            }
            #table tr:nth-child(even) {
                background-color: #eee;
            }
            #table tr:nth-child(odd) {
                background-color:#fff;
            }
            #table th {
                background-color: black;
                color: white;
            }
        </style>

        <script type="text/javascript" src="js/jquery-3.1.1.min.js"></script>

        <!-- compulsory -->
        <script type="text/javascript" src="js/tableExport.js"></script>
        <script type="text/javascript" src="js/jquery.base64.js"></script>

        <!-- for png -->
        <script type="text/javascript" src="js/html2canvas.js"></script>

        <!-- for pdf -->
        <script type="text/javascript" src="js/jspdf.js"></script>
        <script type="text/javascript" src="libs/sprintf.js"></script>
        <script type="text/javascript" src="libs/base64.js"></script>


        <script type="text/javascript" >
            $(document).ready(function (e) {
                $("#buttonExport").click(function (e) {
                    var file = $('#file').val();
                    if (file == "pdf") {
                        $("#table").tableExport(
                                {type: 'pdf',
                                    pdfFontSize: '12',
                                    escape: 'false'
                                });
                    } else if (file == "xls") {
                        $("#table").tableExport(
                                {type: 'excel',
                                    escape: 'false'
                                });
                    } else if (file == "csv") {
                        $("#table").tableExport(
                                {type: 'csv',
                                    escape: 'false'
                                });
                    } else if (file == "png") {
                        $("#table").tableExport(
                                {type: 'png',
                                    escape: 'false'
                                });
                    } else if (file == "txt") {
                        $("#table").tableExport(
                                {type: 'txt',
                                    escape: 'false'
                                });
                    }
//                    document.getElementById("demo").innerHTML = file;
                    return false;
                });
            });
        </script>
    </head>
    <body>

        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
            <label for="exportFile">Export File : </label>
            <select id="file">
                <option value="pdf">PDF</option>
                <option value="xls">XLS</option>
                <option value="csv">CSV</option>
                <option value="png">PNG</option>
                <option value=txt>TXT</option>
            </select>
            <button id="buttonExport" type="submit">Export</button>  
        </form>
        <!--<p id="demo">js</p>-->

        <table id="table">
            <thead>
                <tr>
                    <th>ClientNO</th>
                    <th>Firstname</th>
                    <th>Lastname</th>
                    <th>Viewdate</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "root";
                $dbname = "dreamhome";

                try {
                    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
                    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                    $stmt = $conn->prepare("SELECT Client.clientno, Client.fname, Client.lname, Viewing.viewdate FROM Client
                                   INNER JOIN Viewing ON Client.clientno=Viewing.clientno");
                    $stmt->execute();

                    // set the resulting array to associative
                    $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $output = "";
                    foreach ($stmt as $k => $v) {
                        echo '<tr>
                        <td>' . $v["clientno"] . '</td>
                        <td>' . $v["fname"] . '</td>
                        <td>' . $v["lname"] . '</td>
                        <td>' . $v["viewdate"] . '</td>
                        
                   </tr>
                        ';
                        ;
                    }
                } catch (PDOException $e) {
                    echo "Error: " . $e->getMessage();
                }
                $conn = null;
                ?>
            </tbody>
        </table>
    </body>
</html>
