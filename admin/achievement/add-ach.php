<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Achievement</title>
    <style>
        /* General Styles */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        /* Container for the form */
        .form-container {
            background-color: white;
            border-radius: 10px;
            box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);
            padding: 40px;
            width: 100%;
            max-width: 500px;
        }

        /* Form styles */
        form {
            display: flex;
            flex-direction: column;
        }

        h1 {
            text-align: center;
            color: #4a90e2;
            margin-bottom: 30px;
            font-size: 24px;
        }

        label {
            font-size: 14px;
            margin-bottom: 5px;
            font-weight: bold;
            color: #4a90e2;
        }

        select,
        input[type="text"],
        input[type="number"],
        input[type="date"],
        textarea {
            padding: 12px;
            border-radius: 5px;
            border: 1px solid #ddd;
            font-size: 14px;
            margin-bottom: 20px;
            width: 100%;
            box-sizing: border-box;
        }

        textarea {
            resize: none;
        }

        /* Button styles */
        button {
            background-color: #4a90e2;
            color: white;
            padding: 12px;
            border: none;
            border-radius: 5px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #357ABD;
        }

        /* Style for form fields focus */
        select:focus,
        input[type="text"]:focus,
        input[type="number"]:focus,
        input[type="date"]:focus,
        textarea:focus {
            border-color: #4a90e2;
            outline: none;
            box-shadow: 0px 0px 8px rgba(74, 144, 226, 0.3);
        }
    </style>
</head>

<body>
    <div class="form-container">
        <h1>Add New Achievement</h1>
        <form action="add-proses.php" method="POST">
            <label for="idteam">Team Name:</label>
            <select name="idteam" id="idteam" required>
                <option value="" disabled selected>Select a Team</option>
                <?php
                $mysqli = new mysqli("localhost", "root", "", "esport");

                if ($mysqli->connect_error) {
                    die("Connection failed: " . $stmt->connect_error);
                }

                $sql = "SELECT idteam, name FROM team";
                $stmt = $mysqli->prepare($sql);
                $stmt->execute();
                $result = $stmt->get_result();
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['idteam'] . "'>" . $row['name'] . "</option>";
                }
                $mysqli->close();
                ?>
            </select>

            <label for="name">Achievement Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="date">Date:</label>
            <input type="date" name="date" required>

            <label for="description">Description:</label>
            <textarea name="description" rows="4" required></textarea>
            <input type="submit" value="add">
        </form>
    </div>
</body>
</html>