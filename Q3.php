<!DOCTYPE html>
<html>

<head>
    <title>P4Q3</title>
    <style>
        body {
            font-size: 18px;
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }

        .container {
            display: flex;
            justify-content: space-between;
        }

        .title {
            flex: 1;
        }

        .code,
        .output {
            flex: 1;
            padding: 20px;
            background-color: #f7f7f7;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
            overflow: auto;
            margin-right: 20px;
            height: 600px;
        }

        pre {
            white-space: pre-wrap;
            margin: 0;
        }

        h2 {
            margin-top: 0;
        }
    </style>
</head>

<body>
    <h1>Q2 - List Student - Version 2</h1>
    <div class="explaination">
        <h2>Explanation:</h2>
        <p>
            This PHP script retrieves student information from the database and displays it in a table. The database
            connection details are defined in the "helper.php" file. The script establishes a connection to the database
            using mysqli_connect and retrieves all records from the Student table using a SELECT query. It then loops through
            the result set and displays each student's ID, name, gender, and program in a table row. The number of records
            returned is also displayed at the bottom of the table. Finally, the script frees the result set and closes the
            database connection.
        </p>
    </div>
    <div class="container">
        <div class="title">
            <h2>PHP Code:</h2>
        </div>
        <div class="title">
            <h2>Output:</h2>
        </div>

    </div>
    <div class="container">
        <div class="code">
            <?php
            highlight_file('list-student-Q3(Procedural).php');
            ?>
        </div>
        <div class="output">
            <?php
            require_once('list-student-Q3(Procedural).php');
            ?>
        </div>
    </div>
</body>

</html>
