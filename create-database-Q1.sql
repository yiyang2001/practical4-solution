/* 
    Q1(a)
    create a new MySQL database and name the database as "p4".
    check if the database is exist, if yes, drop the database and create a new one.

    Eg:
    DROP DATABASE IF EXISTS database_name;

    CREATE DATABASE database_name;

    USE database_name;
*/ 
-- Write your SQL statement below this line



/* 
    Q1(b)
    create a new table and name the table as Student. The table should have the following columns:

    -------------------------------------------------------
    | Key | Index | Null | Column Name | Data Type | Size |
    -------------------------------------------------------
    |  √  |   √   |  √   |  StudentID  |   CHAR    |  10  |
    -------------------------------------------------------
    |     |       |      | StudentName | VARCHAR   |  30  |
    -------------------------------------------------------
    |     |       |      |   Gender    |   CHAR    |   1  | - F or M
    -------------------------------------------------------
    |     |       |      |  Program    |   CHAR    |   2  | - IA, IB, IT
    -------------------------------------------------------

    Eg:
    CREATE TABLE table_name (
        column_name1 data_type(size) not null,
        column_name2 data_type(size) not null,
        column_name3 data_type(size) not null,
        column_name4 data_type(size) not null,
        PRIMARY KEY (column_name1)
    );
*/
-- Write your SQL statement below this line



/* 
    Q1(c)
    Insert some records into the Student table.
    
    StudentID    StudentName    Gender    Program
    10ABC00001   Phea Lee Mai   F         IA
    10ABC00002   Tan Wai Beng   F         IB
    10ABC00003   Chau Guan Hin  M         IT
    10ABC00004   Tan Tai Ling   M         IB
    10ABC00005   Lee Siok Hwee  F         IT
    10ABC00006   Liaw Chun Voon M         IA

    Eg:
    INSERT INTO table_name (column_name1, column_name2, column_name3, column_name4) 
    VALUES (value1, value2, value3, value4);
*/
-- Write your SQL statement below this line

DROP SCHEMA IF EXISTS p4;

CREATE SCHEMA p4;

USE p4;

CREATE TABLE Student (
    StudentID CHAR(10) NOT NULL,
    StudentName VARCHAR(30) NOT NULL,
    Gender CHAR(1) NOT NULL,
    Program CHAR(2) NOT NULL,
    PRIMARY KEY (StudentID)
);

INSERT INTO
Student (StudentID, StudentName, Gender, Program)
VALUES
('10ABC00001', 'Phea Lee Mai'  , 'F', 'IA'),
('10ABC00002', 'Tan Wai Beng'  , 'F', 'IB'),
('10ABC00003', 'Chau Guan Hin' , 'M', 'IT'),
('10ABC00004', 'Tan Tai Ling'  , 'M', 'IB'),
('10ABC00005', 'Lee Siok Hwee' , 'F', 'IT'),
('10ABC00006', 'Liaw Chun Voon', 'M', 'IA');