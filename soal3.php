<!DOCTYPE html>
<html>

<head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>
</head>

<body>

    <?php

    $nama = $_GET['nama'] ?? null;
    $alamat = $_GET['alamat'] ?? null;

    $sql = "";

    if (isset($_GET['nama']) && $_GET['alamat']) {
        $nama = $_GET['nama'];
        $alamat = $_GET['alamat'];
        $sql = "SELECT person.nama, person.alamat, hobi.hobi from person inner join hobi on person.id = hobi.person_id where person.nama LIKE '%".$nama."%' and person.alamat LIKE '%".$alamat."%'";
    } else {
        $sql = "SELECT person.nama, person.alamat, hobi.hobi from person inner join hobi on person.id = hobi.person_id";
    }
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "testdb";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }


    $result = $conn->query($sql);

    if ($result->num_rows > 0) {

    } else {
        echo "0 results";
    }

    $conn->close();
    ?>

</body>
<table>
    <tr>
        <th><b>Nama</b></th>
        <th><b>Alamat</b></th>
        <th><b>Hobi</b></th>
    </tr>
    <?php
    while ($row = $result->fetch_assoc()) {
        echo '<tr>';
        echo '<td>' . $row['nama'] . '</td>';
        echo '<td>' . $row['alamat'] . '</td>';
        echo '<td>' . $row['hobi'] . '</td>';
        echo '</tr>';
    }
    ?>

</table>

<form action="soal3.php" method="GET">
    <label for="nama">Nama:</label><br>
    <input type="text" id="nama" name="nama" required><br>
    <label for="alamat">Alamat:</label><br>
    <input type="text" id="alamat" name="alamat" required><br><br>
    <input type="submit" value="Submit">
</form>

</html>