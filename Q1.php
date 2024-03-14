<!DOCTYPE html>
<html>

<head>
    <title>MySQL Tutorial</title>
    <style>
        body {
            font-size: 20px; 
            font-family: Arial, sans-serif;
            margin: 20px;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        h2 {
            color: #333;
        }

        /* pre {
            background-color: #f4f4f4;
            color: #333;
            padding: 10px;
            border-radius: 5px;
            font-family: monospace;
            white-space: pre-wrap;
        } */
        pre {
            background-color: #f7f7f7;
            padding: 10px;
            border: 1px solid #ccc;
            margin-bottom: 20px;
            white-space: pre-wrap;
        }
        p {
            color: #333;
        }
    </style>
</head>

<body>
    <h1>MySQL Tutorial</h1>

    <h2>Q1(a) Create and Use Database</h2>
    <p>Create a new MySQL database named "p4". Check if the database exists; if yes, drop the database and create a new
        one.</p>
    <pre>
-- Drop database if exists
DROP DATABASE IF EXISTS p4;

-- Create new database
CREATE DATABASE p4;

-- Use the newly created database
USE p4;</pre>
    <p>Execute the above SQL commands to create a new database named 'p4' and use it.</p>

    <h2>Q1(b) Create Table</h2>
    <p>Create a new table named "Student" with the specified columns.</p>
    <table border="1" cellpadding="5" cellspacing="0">
        <tr>
            <th>Key</th>
            <th>Index</th>
            <th>NULL</th>
            <th>Column</th>
            <th>Data Type</th>
            <th>Size</th>
        </tr>
        <tr>
            <td>√</td>
            <td>√</td>
            <td>√</td>
            <td>StudentID</td>
            <td>CHAR</td>
            <td>10</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>StudentName</td>
            <td>VARCHAR</td>
            <td>30</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Gender</td>
            <td>CHAR</td>
            <td>1</td>
        </tr>
        <tr>
            <td></td>
            <td></td>
            <td></td>
            <td>Program</td>
            <td>CHAR</td>
            <td>2</td>
        </tr>
    </table>
    <b><u>NOTE:</u></b>
    <ul>
        <li><b>Gender</b> field holds <u>F</u> (Female) or <u>M</u> (Male).</li>
        <li><b>Program</b> field holds <u>IA</u> (Information Systems Engineering), <u>IB</u> (Business Information
            Systems) or <u>IT</u> (Internet Technology).</li>
    </ul>
    <pre>
CREATE TABLE Student (
    StudentID CHAR(10) NOT NULL,
    StudentName VARCHAR(30) NOT NULL,
    Gender CHAR(1) NOT NULL,
    Program CHAR(2) NOT NULL,
    PRIMARY KEY (StudentID)
);</pre>
    <p>Execute the above SQL command to create a new table named 'Student' with the specified columns.</p>



    <h2>Q1(c) Insert Records</h2>
    <p>Insert some records into the 'Student' table.</p>
    <pre>
INSERT INTO Student (StudentID, StudentName, Gender, Program)
VALUES
    ('10ABC00001', 'Phea Lee Mai', 'F', 'IA'),
    ('10ABC00002', 'Tan Wai Beng', 'F', 'IB'),
    ('10ABC00003', 'Chau Guan Hin', 'M', 'IT'),
    ('10ABC00004', 'Tan Tai Ling', 'M', 'IB'),
    ('10ABC00005', 'Lee Siok Hwee', 'F', 'IT'),
    ('10ABC00006', 'Liaw Chun Voon', 'M', 'IA');</pre>
    <p>Execute the above SQL command to insert records into the 'Student' table.</p>

</body>

</html>