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
    $studentId_error = Validation\stringValid($studentId, 10);   
    $fName_error = Validation\stringValid($fName, 15);  
    $lName_error = Validation\stringValid($lName, 15);    
    
    //Validation namespace numeric check
    try {
        Validation\numericValue($grade);
    }
    catch (Exception $e) {
        $grade_error = $e->getMessage();
    }
?>
<html>
<head>
    <title>Angeline Ortiz Midterm Practical</title>
</head>
<body>
    <h1>Angeline Ortiz Midterm Practical</h1>
    <h2>Add a New Student</h2>
    <form method='POST'>
        <h3>Student ID: <input type="text" name="studentId" required
            value="<?php echo $user->getUserId(); ?>">
            <?php if (strlen($studentId_error) > 0) 
                echo "<span style='color: red;'>{$studentId_error}</span>"; ?>
        </h3>
        <h3>Password: <input type="text" name="password"
            value="<?php echo $user->getPassword(); ?>">
            <?php if (strlen($password_error) > 0) 
                echo "<span style='color: red;'>{$password_error}</span>"; ?>
        </h3>
        <h3>First Name: <input type="text" name="fName" required
            value="<?php echo $user->getFirstName(); ?>">
            <?php if (strlen($fName_error) > 0) 
                echo "<span style='color: red;'>{$fName_error}</span>"; ?>
        </h3>
        <h3>Last Name: <input type="text" name="lName" required
            value="<?php echo $user->getLastName(); ?>">
            <?php if (strlen($lName_error) > 0) 
                echo "<span style='color: red;'>{$lName_error}</span>"; ?>
        </h3>
        <h3>Hire Date: <input type="date" name="hireDate" required
            value="<?php echo $contact->getHireDate(); ?>">
        </h3>
        <h3>E-Mail: <input type="text" name="eMail" required
            value="<?php echo $user->getEMail(); ?>">
            <?php if (strlen($eMail_error) > 0) 
                echo "<span style='color: red;'>{$eMail_error}</span>"; ?>
        </h3>
        <h3>Extension: <input type="text" name="extension" required
            value="<?php echo $user->getExtension(); ?>">
            <?php if (strlen($state_error) > 0) 
                echo "<span style='color: red;'>{$extension_error}</span>"; ?>
        </h3>
        <h3>Level: <select name="userLevelNo">
            <?php foreach($level as $levels) : ?>
                <option value="<?php echo $level->getUserLevelNo(); ?>" 
                    <?php if ($level->getUserLevelNo() ===
                        $user->getUserLevelNo()->getUserLevelNo()) { 
                            echo 'selected'; }?>>
                <?php echo $level->getLevelName(); ?></option> 
            <?php endforeach ?>
        </select>
        <input type="hidden"
            value="<?php echo $user->getUserNo(); ?>" name="uNo"> 
        <input type="submit" value="Validate Values">
        <iut type="submit" value="Save" name="save">
        <input type="submit" value="Cancel" name="cancel">
    </form>
    <h3><?php
        if (strlen($userId_error) > 0 || strlen($password_error) > 0 || strlen($fName_error) > 0 || strlen($lName_error) > 0 
            || strlen($hireDate_error) > 0 || strlen($eMail_error) > 0 || strlen($extension_error) > 0 || strlen($userLevelNo_error) > 0) { 
            echo "There are validation errors!";
        } else {
            echo "All fields validate - no errors!";
        }
        ?>
</body>
</html>