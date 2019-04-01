<html>
 <head>
 <Title>User Form</Title>
 <style type="text/css">
 	body { background-color: #fff; border-top: solid 10px #000;
 	    color: #333; font-size: .85em; margin: 20; padding: 20;
 	    font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
 	}
 	h1, h2, h3,{ color: #000; margin-bottom: 0; padding-bottom: 0; }
 	h1 { font-size: 2em; }
 	h2 { font-size: 1.75em; }
 	h3 { font-size: 1.2em; }
 	table { margin-top: 0.75em; }
 	th { font-size: 1.2em; text-align: left; border: none; padding-left: 0; }
 	td { padding: 0.25em 2em 0.25em 0em; border: 0 none; }
 </style>
 </head>
 <body>
 <h1>Tambahkan nama!</h1>
 <p>Tulis nama depan dan belakang, lalu klik <strong>Submit</strong> untuk menambahkan.</p>
 <form method="post" action="index.php" enctype="multipart/form-data" >
       Firstname  <input type="text" name="firstname" id="firstname"/></br></br>
       Lastname <input type="text" name="lastname" id="lastname"/></br></br>
       <input type="submit" name="submit" value="Submit" />
       <input type="submit" name="load_data" value="Load Data" />
 </form>
 <?php
    $host = "anggastudioserver.database.windows.net";
    $user = "anggastudio";
    $pass = "Leoleoleo123*";
    $db = "anggastudiodb";

    try {
        $conn = new PDO("sqlsrv:server = $host; Database = $db", $user, $pass);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch(Exception $e) {
        echo "Failed: " . $e;
    }

    if (isset($_POST['submit'])) {
        try {
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            // Insert data
            $sql_insert = "INSERT INTO User (firstname, lastname) VALUES (?,?)";
            $stmt = $conn->prepare($sql_insert);
            $stmt->bindValue(1, $lastname);
            $stmt->bindValue(2, $lastname);
            $stmt->execute();
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }

        echo "<h3>Berhasil ditambahkan!</h3>";
    } else if (isset($_POST['load_data'])) {
        try {
            $sql_select = "SELECT * FROM User";
            $stmt = $conn->query($sql_select);
            $registrants = $stmt->fetchAll(); 
            if(count($registrants) > 0) {
                echo "<h2>Nama yang telah ditambahkan:</h2>";
                echo "<table>";
                echo "<tr><th>Firstname</th>";
                echo "<th>Lastname</th>";
                foreach($registrants as $registrant) {
                    echo "<tr><td>".$registrant['firstname']."</td>";
                    echo "<td>".$registrant['lastname']."</td>";
                }
                echo "</table>";
            } else {
                echo "<h3>Belum ada yang ditambahkan</h3>";
            }
        } catch(Exception $e) {
            echo "Failed: " . $e;
        }
    }
 ?>
 </body>
 </html>