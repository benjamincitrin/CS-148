<?php

//##############################################################################
//
// This page lists your tables and fields within your database. if you click on
// a database name it will show you all the records for that table. 
// 
// 
// This file is only for class purposes and should never be publicly live
//##############################################################################
include "top.php";

$queryNumber = 0;

if (isset($_GET['getRecordsFor'])) {
    $queryNumber = (int) $_GET['getRecordsFor'];
}

// Begin output
print '<article>';

$info2=null;
$columns=5;

// print out a list of all the tables and their description
// make each table name a link to display the record
print '<section id="tables2" class="float_left">';

print '<table>';

switch ($queryNumber) {
    case(1):
          $query = 'SELECT pmkNetId FROM tblTeachers';
            //print $thisDatabaseReader->testquery($query, "", 0, 0, 0, 0, false, false);
            $info2 = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
               $columns = 1;
           break;
    case(2):
          $query = "SELECT fldDepartment FROM tblCourses WHERE fldCourseName LIKE 'Introduction%'";
            //print $thisDatabaseReader->testquery($query, "", 1, 0, 2, 0, false, false);
            $info2 = $thisDatabaseReader->select($query, "", 1, 0, 2, 0, false, false);
               $columns = 1;
           break;
    case(3):
          $query = "SELECT * FROM tblSections WHERE fldStart='13:10:00' AND fldBuilding='Kalkin'";
            //print $thisDatabaseReader->testquery($query, "", 1, 1, 4, 0, false, false);
            $info2 = $thisDatabaseReader->select($query, "", 1, 1, 4, 0, false, false);
               $columns = 1;
           break;
    case(4):
        $columns = 5;
          $query = "SELECT * FROM tblCourses WHERE fldCourseName='Database Design for the Web'";
            print $thisDatabaseReader->testquery($query, "", 1, 0, 2, 0, false, false);
            $info2 = $thisDatabaseReader->select($query, "", 1, 0, 2, 0, false, false);
               
           break; 
    case(5):
          $query = "SELECT fldFirstName, fldLastName FROM tblTeachers WHERE pmkNetId LIKE 'r%o'";
            //print $thisDatabaseReader->testquery($query, "", 1, 0, 2, 0, false, false);
            $info2 = $thisDatabaseReader->select($query, "", 1, 0, 2, 0, false, false);
               $columns = 1;
           break;
    case(6):
          $query = "SELECT fldCourseName FROM tblCourses WHERE fldCourseName LIKE '%data%' AND fldDepartment != 'CS'";
            //print $thisDatabaseReader->testquery($query, "", 1, 2, 4, 0, false, false);
            $info2 = $thisDatabaseReader->select($query, "", 1, 2, 4, 0, false, false);
               $columns = 1;
           break;  
    case(7):
          $query = "SELECT DISTINCT fldDepartment FROM tblCourses";
            //print $thisDatabaseReader->testquery($query, "", 0, 0, 0, 0, false, false);
            $info2 = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
               $columns = 1;
           break;  
    case(8):
          //$query = "SELECT DISTINCT fldBuilding FROM tblSections";
        $query = "SELECT fldBuilding, COUNT(fldSection) FROM tblSections GROUP BY fldBuilding";
            print $thisDatabaseReader->testquery($query, "", 0, 0, 0, 0, false, false);
            $info2 = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);
               $columns = 2;
           break; 
   case(9):
         $query = "SELECT fldBuilding, fldNumStudents FROM tblSections WHERE fldDays LIKE '%W%'";
            print $thisDatabaseReader->testquery($query, "", 1, 0, 2, 0, false, false);
            $info2 = $thisDatabaseReader->select($query, "", 1, 0, 2, 0, false, false);
               $columns = 2;
           break; 
}

/*
$results = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);

// loop through all the tables in the database, display fields and properties
foreach ($results as $row) {

    // table name link
    print '<tr class="odd">';
    print '<th colspan="6">';
    print '<a href="?getRecordsFor=' . htmlentities($row[0], ENT_QUOTES) . "#" . htmlentities($row[0], ENT_QUOTES) . '">';
    print htmlentities($row[0], ENT_QUOTES) . '</a>';
    print '</th>';
    print '</tr>';

    //get the fields and any information about them
    $query = 'SHOW COLUMNS FROM ' . $row[0];
    $results2 = $thisDatabaseReader->select($query, "", 0, 0, 0, 0, false, false);

    foreach ($results2 as $row2) {
        print '<tr>';
        print '<td>' . $row2['Field'] . '</td>';
        print '<td>' . $row2['Type'] . '</td>';
        print '<td>' . $row2['Null'] . '</td>';
        print '<td>' . $row2['Key'] . '</td>';
        print '<td>' . $row2['Default'] . '</td>';
        print '<td>' . $row2['Extra'] . '</td>';
        print '</tr>';
    }
}
print '</table>';
print '</section>';

// Display all the records for a given table
if ($tableName != "") {
    print '<aside id="records">';

    $query = 'SHOW COLUMNS FROM ' . $tableName;
    $info = $thisDatabaseReader->select($query,  "", 0, 0, 0, 0, false, false);

    $span = count($info);

    //print out the table name and how many records there are
    print '<table>';

    $query = 'SELECT * FROM ' . $tableName;
    $a = $thisDatabaseReader->select($query,  "", 0, 0, 0, 0, false, false);

    print '<tr>';
    print '<th colspan=' . $span . '>' . $query;
    print '</th>';
    print '</tr>';

    print '<tr>';
    print '<th colspan=' . $span . '>' . $tableName;
    print ' ' . count($a) . ' records';
    print '</th>';
    print '</tr>';*/

    // print out the column headings, note i always use a 3 letter prefix
    // and camel case like pmkCustomerId and fldFirstName
    print '<tr>';
    $columns = 0;
    foreach ($info as $field) {
        print '<td>';
        $camelCase = preg_split('/(?=[A-Z])/', substr($field[0], 3));

        foreach ($camelCase as $one) {
            print $one . " ";
        }

        print '</td>';
        $columns++;
    }
    print '</tr>';

    //now print out each record

    $highlight = 0; // used to highlight alternate rows
    foreach ($info2 as $rec) {
        $highlight++;
        if ($highlight % 2 != 0) {
            $style = ' odd ';
        } else {
            $style = ' even ';
        }
        print '<tr class="' . $style . '">';
        for ($i = 0; $i < $columns=1; $i++) {
            print '<td>' . $rec[$i] . '</td>';
        }
        print '</tr>';
    }

    // all done
    print '</table>';
    print '</aside>';
//}
print '</article>';
include "footer.php";
?>