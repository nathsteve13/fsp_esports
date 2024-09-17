<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Member</title>
    <link rel="stylesheet" href="adminstyle.css">
</head>
<body>
    <?php 
        $mysqli = new mysqli("localhost", "root", "", "esport");
        if ($mysqli->connect_errno) {
            die("Failed to connect to MySQL: " . $mysqli->connect_error);
        }

        $idmember = $_GET['idmember'];

        $sql = "SELECT * FROM member WHERE idmember = ?";
        $stmt = $mysqli->prepare($sql);
        if (!$stmt) {
            die("SQL error: " . $mysqli->error);
        }
        $stmt->bind_param("i", $idmember);
        $stmt->execute();
        $res = $stmt->get_result();
        $member = $res->fetch_assoc();
        
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $fname = $_POST['first-name'];
            $lname = $_POST['last-name'];

            $sqlupdate = "update member set fname = ?, lname = ? where idmember = ?";
            $stmt = $mysqli->prepare($sqlupdate);
            $stmt->bind_param("ssi", $fname, $lname, $idmember);

            if ($stmt->execute()) {
                header("location: member-read.php");
            } else {
                echo "Update failed : ".$stmt->error;
            }
        }

        $mysqli->close();
    ?>
    <div class="container">
        <h1>PROFILE</h1>
        <form method="POST">
            <div class="form-group">
                <label>First Name : </label>
                <input type="text" id="first-name" name="first-name"  value="<?php echo $member['fname']; ?>" required>
            </div>
            
            <div class="form-group">
                <label>Last Name : </label>
                <input type="text" id="last-name" name="last-name" value="<?php echo $member['lname']; ?>" required>
            </div>

            <div class="form-group">
                <input type="submit" value="Update Member">
            </div>

            <a href="member-read.php">Back to member view</a>
        </form>
    </div>
</body>
</html>