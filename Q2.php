<!DOCTYPE html>
<html>

<head>
    <title>P4Q2</title>
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
    <h1>Q2 - List Student - Version 1</h1>
    <div class="explaination">
        <h2>Explanation:</h2>
        <p>This PHP script retrieves student information from the database and displays it in a table. The database
            connection details are defined in the "helper.php" file. The "mysqli_connect" function is used to open a new
            connection to the MySQL server. If the connection fails, the "mysqli_connect_error" function returns the
            error description from the last connection error. The "mysqli_query" function performs a query against the
            database. The "mysqli_num_rows" function returns the number of rows in a result set. The
            "mysqli_fetch_array" function fetches a result row as an associative array, a numeric array, or both. The
            "mysqli_free_result" function frees the memory associated with the result. The "mysqli_close" function
            closes a previously opened database connection.</p>
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
            highlight_file('list-student-Q2(Procedural).php');
            ?>
        </div>
        <div class="output">
            <?php
            require_once('list-student-Q2(Procedural).php');
            ?>
        </div>
    </div>
</body>

</html>