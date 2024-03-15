<?php
///////////////////////////////////////////////////////////////////////////////
// Database connection details ////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

// Constants. Please change accordingly.
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'p4');

///////////////////////////////////////////////////////////////////////////////
// Lookup tables //////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

// P4Q3 (List Student – Version 2)
// Return an array of all states.
function getPrograms()
{
    return array(
        'IA' => 'Information Systems Engineering',
        'IB' => 'Business Information Systems',
        'IT' => 'Internet Technology'
    );
}

// Return an array of all genders.
function getGenders()
{
    return array(
        'F' => 'Female',
        'M' => 'Male'
    );
}

// Array versions of lookup tables.
$PROGRAMS = getPrograms();
$GENDERS = getGenders();

///////////////////////////////////////////////////////////////////////////////
// Validators /////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////////////

// Validate Student ID.
// Return nothing if no error.
function validateStudentID($id)
{
    if ($id == null)
    {
        return 'Please enter <strong>Student ID</strong>.';
    }
    else if (!preg_match('/^\d{2}[A-Z]{3}\d{5}$/', $id))
    {
        return '<strong>Student ID</strong> is of invalid format. Format: 99XXX99999.';
    }
    else if (isStudentIDExist($id))
    {
        return '<strong>Student ID</strong> given already exist. Try another.';
    }
}

// Check if Student ID already exist.
// Used by function validateStudentID().
function isStudentIDExist($id)
{
    // Flag to indicate if Student ID exist.
    $exist = false;
    
    // https://www.w3schools.com/php/php_mysql_connect.asp
    // Step 1 : Connect to Database
    $con = mysqli_connect(DB_HOST,DB_USER,DB_PASS,DB_NAME);

    // Step 2: Check Database connection connect successfully
    if (mysqli_connect_errno()){
        die ('Connection Failed'. mysqli_connect_error());
    }
    // https://www.w3schools.com/php/func_mysqli_real_escape_string.asp
    // https://stackoverflow.com/questions/6327679/what-does-mysql-real-escape-string-really-do
    
    // Step 3 : Sanitize the input
    $id  = mysqli_escape_string($con, $id);

    // Step 4 : Prepare SQL Statement
    $sql = "SELECT * FROM Student WHERE StudentID = '$id'";

    // Step 5 : Execute the Query and store in $result
    if ($result = mysqli_query($con, $sql))
    {
        // Step 6 : Check if the number of row inside $result is more than 0, if yes, set $exist to true.
        if (mysqli_num_rows($result) > 0)
        {
            $exist = true;
        }
    }
    
    // Step 7 : Release the resource
    // https://www.w3schools.com/php/func_mysqli_free_result.asp
    mysqli_free_result($result);
    // https://www.w3schools.com/php/func_mysqli_close.asp
    mysqli_close($con);
    return $exist;
}

// Validate Student Name.
// Return nothing if no error.
function validateStudentName($name)
{
    if ($name == null)
    {
        return 'Please enter <strong>Student Name</strong>.';
    }
    else if (strlen($name) > 30) // Prevent hacks.
    {
        return '<strong>Student Name</strong> must not more than 30 letters.';

    }
    else if (!preg_match('/^[A-Za-z @,\'\.\-\/]+$/', $name))
    {
        return 'There are invalid letters in <strong>Student Name</strong>.';
    }
}

// Validate Gender.
// Return nothing if no error.
function validateGender($gender)
{
    if ($gender == null)
    {
        return 'Please select a <strong>Gender</strong>.';
    }
    else if (!array_key_exists($gender, getGenders())) // Prevent hacks.
    {
        return 'Invalid <strong>Gender</strong> code detected.';
    }
}

// Validate Program.
// Return nothing if no error.
function validateProgram($program)
{
    if ($program == null)
    {
        return 'Please select a <strong>Program</strong>.';
    }
    else if (!array_key_exists($program, getPrograms())) // Prevent hacks.
    {
        return 'Invalid <strong>Program</strong> code detected.';
    }
}

function print_array($result) {
    echo "<pre>";
    print_r($result);
    echo "</pre>";
}

?>
