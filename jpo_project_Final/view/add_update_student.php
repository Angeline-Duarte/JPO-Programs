<?php
    require_once('../controller/students.php');
    require_once('../controller/student_controller.php');
    require_once('../validation.php');

    //default person for add - empty strings and first role 
    //in list
    $student = new Student('', '', '', date('Y-m-d'), '', '', '', ''); 
    $student->setStudentNo(-1);
    $pageTitle = "Add a New Student";

    //Retrieve the personNo from the query string and 
    //and use it to create a person object for that pNo 
    if (isset($_GET['sNo'])) {
        $student =
            StudentController::getStudent($_GET['sNo']);
        $pageTitle = "Update an Existing Student";
    }

    if (isset($_POST['save'])) {
        //save button - perform add or update
        //roleOptions are 1, 2, 3...the $roles array is base 
        //0 index, so subtract 1 from the selected option to 
        //get the correct index
        $student = new Student($_POST['studentId'],$_POST['fName'], $_POST['lName'],
            $_POST['dob'], $_POST['programNo'], $_POST['programName'], $_POST['charges'], $_POST['grade']);
        $student->setStudentNo($_POST['sNo']);

        if ($student->getStudentNo() === '-1') {
            //add
            StudentController::addStudent($student);
        } else {
            //update
            StudentController::updateStudent($student);
        }

        //return to people list
        header('Location: ./display_student.php');
    }

    if (isset($_POST['cancel'])) {
    //cancel button - just go back to list 
    header('Location: ./display_student.php');
    }

    //----------------------------------------------------------------------
    //VALIDATION
    //Declare and clear variables
    $studentId = '';
    $fName = '';
    $lName = '';
    $dob = '';
    $programNo = '';
    $programName = '';
    $charges = '';
    $grade = '';


    //Declare and clear variables for error messages
    $studentId_error = '';
    $fName_error = '';
    $lName_error = '';
    $dob_error = '';
    $programNo_error = '';
    $programName_error = '';
    $charges_error = '';
    $grade_error = '';

    //Retrieve values from query string and store in a local variable 
    //as long as the query string exists (which it does not on first 
    //load of a page).
    if (isset($_POST['studentId'])) 
        $studentId = $_POST['studentId'];
 
    if (isset($_POST['fName'])) 
        $fName = $_POST['fName'];

    if (isset($_POST['lName'])) 
        $lName = $_POST['lName'];

    if (isset($_POST['dob'])) 
        $dob = $_POST['dob'];

    if (isset($_POST['programNo'])) 
        $programNo = $_POST['programNo'];

    if (isset($_POST['programName'])) 
        $programName = $_POST['programName'];

    if (isset($_POST['charges'])) 
        $charges = $_POST['charges'];

    if (isset($_POST['grade'])) 
        $grade = $_POST['grade'];

    //Validate the values entered
    //Call stringLengthValidation from the Validation namespace 
    $charges_error = Validation\stringValid($charges, 5);   
    $fName_error = Validation\stringValid($fName, 5);  
    $lName_error = Validation\stringValid($lName, 5);    
    
    //Validation  charges namespace numeric check
    try {
        Validation\numericValue($grade);
    }
    catch (Exception $e) {
        $grade_error = $e->getMessage();
    }

    //Validation student id namespace numeric check
    try {
        Validation\numericValue($studentId);
    }
    catch (Exception $e) {
        $studentId_error = $e->getMessage();
    }
?>
<html>
<head>
    <title>JPO Programs</title>
    <link rel="stylesheet" type="text/css" href="styles.css"/> 
</head>
<body>
    <h1>JPO Programs</h1>
    <h2>Add a New Student</h2>
    <form method='POST'>
        <h3>Student ID: <input type="text" name="studentId"
            value="<?php echo $student->getStudentId(); ?>">
            <?php if (strlen($studentId_error) > 0) 
                echo "<span style='color: red;'>{$studentId_error}</span>"; ?>
        </h3>
        <h3>First Name: <input type="text" name="fName"
            value="<?php echo $student->getStudentFirstName(); ?>">
            <?php if (strlen($fName_error) > 0) 
                echo "<span style='color: red;'>{$fName_error}</span>"; ?>
        </h3>
        <h3>Last Name: <input type="text" name="lName"
            value="<?php echo $student->getStudentLastName(); ?>">
            <?php if (strlen($lName_error) > 0) 
                echo "<span style='color: red;'>{$lName_error}</span>"; ?>
        </h3>
        <h3>Date of Birth: <input type="date" name="dob"
            value="<?php echo $student->getDOB(); ?>">
        </h3>
        <h3>Program Number: <select name="programNo">
            <?php foreach($program as $programs) : ?>
                <option value="<?php echo $program->getProgramNo(); ?>" 
                    <?php if ($program->getProgramNo() ===
                        $student->getProgramNo()->getProgramNo()) { 
                            echo 'selected'; }?>>
                <?php echo $program->getProgramNo(); ?></option> 
            <?php endforeach ?>
        </select>
        </h3>
        <h3>Program Name: <select name="programName">
            <?php foreach($program as $programs) : ?>
                <option value="<?php echo $program->getProgramNo(); ?>" 
                    <?php if ($program->getProgramNo() ===
                        $student->getProgramNo()->getProgramNo()) { 
                            echo 'selected'; }?>>
                <?php echo $program->getName(); ?></option> 
            <?php endforeach ?>
        </select>
        </h3>
        <h3>Charges: <input type="text" name="charges"
            value="<?php echo $student->getCharges(); ?>">
            <?php if (strlen($charges_error) > 0) 
                echo "<span style='color: red;'>{$charges_error}</span>"; ?>
        </h3>
        <h3>
        <h3>Grade: <input type="number" name="grade"
            value="<?php echo $student->getGrade(); ?>">
            <?php if (strlen($grade_error) > 0) 
                echo "<span style='color: red;'>{$grade_error}</span>"; ?>
        </h3>
        <input type="hidden"
            value="<?php echo $student->getStudentNo(); ?>" name="sNo"> 
        <input type="submit" value="Validate Values">
        <input type="submit" value="Save" name="save">
        <input type="submit" value="Cancel" name="cancel">
    </form>
    <h3><?php
        if (strlen($studentId_error) > 0 || strlen($fName_error) > 0 || strlen($lName_error) > 0 || strlen($dob_error) > 0 
            || strlen($programNo_error) > 0 || strlen($ProgramName_error) > 0 || strlen($charges_error) > 0 || strlen($grade_error) > 0) { 
            echo "There are validation errors.";
        } else {
            echo "All fields validate - no errors!";
        }
        ?>
</body>
</html>