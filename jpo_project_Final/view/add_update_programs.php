<?php
    require_once('../controller/program.php');
    require_once('../controller/program_controller.php');
    require_once('../validation.php');

    //default person for add - empty strings and first role 
    //in list
    $program = new program('', '', '', ''); 
    $program->setProgramNo(-1);
    $pageTitle = "Add a New Program";

    //Retrieve the personNo from the query string and 
    //and use it to create a person object for that pNo 
    if (isset($_GET['pNo'])) {
        $program = ProgramController::getProgram($_GET['pNo']);
        $pageTitle = "Update an Existing Program";
    }

    if (isset($_POST['save'])) {
        //save button - perform add or update
        //roleOptions are 1, 2, 3...the $roles array is base 
        //0 index, so subtract 1 from the selected option to 
        //get the correct index
        $program = new Program($_POST['name'],$_POST['address'],$_POST['treatments'], $_POST['beds']);
        $program->setProgramNo($_POST['pNo']);

        if ($program->getProgramNo() === '-1') {
            //add
            ProgramController::addProgram($program);
        } else {
            //update
            ProgramController::updateProgram($program);
        }

        //return to people list
        header('Location: ./display_program.php');
    }

    if (isset($_POST['cancel'])) {
    //cancel button - just go back to list 
    header('Location: ./display_program.php');
    }

    //----------------------------------------------------------------------
    //VALIDATION
    //Declare and clear variables
    $name = '';
    $address = '';
    $treatments = '';
    $beds = '';


    //Declare and clear variables for error messages
    $name_error = '';
    $address_error = '';
    $treatments_error = '';
    $beds_error = '';

    //Retrieve values from query string and store in a local variable 
    //as long as the query string exists (which it does not on first 
    //load of a page).
    if (isset($_POST['name'])) 
        $fName = $_POST['name'];

    if (isset($_POST['address'])) 
        $fName = $_POST['address'];
 
    if (isset($_POST['treatments'])) 
        $fName = $_POST['treatments'];

    if (isset($_POST['beds'])) 
        $lName = $_POST['beds'];


    //Validate the values entered
    //Call stringLengthValidation from the Validation namespace 
    $name_error = Validation\stringValid($name, 5);  
    $address_error = Validation\stringValid($address, 10);  
    $treatments_error = Validation\stringValid($treatments, 5);  
    
    //Validation namespace numeric check
    try {
        Validation\numericValue($beds);
    }
    catch (Exception $e) {
        $beds_error = $e->getMessage();
    }
?>
<html>
<head>
    <title>JPO Programs</title>
    <link rel="stylesheet" type="text/css" href="styles.css"/> 
</head>
<body>
    <h1>JPO Programs</h1>
    <h2>Add a New Program</h2>
    <form method='POST'>
        <h3>Program Name: <input type="text" name="name"
            value="<?php echo $program->getName(); ?>">
            <?php if (strlen($name_error) > 0) 
                echo "<span style='color: red;'>{$name_error}</span>"; ?>
        </h3>
        <h3>Program Address: <input type="text" name="address" required
            value="<?php echo $program->getAddress(); ?>">
            <?php if (strlen($address_error) > 0) 
                echo "<span style='color: red;'>{$address_error}</span>"; ?>
        </h3>
        <h3>Treatments Available: <input type="text" name="treatments" required
            value="<?php echo $program->getTreatments(); ?>">
            <?php if (strlen($treatments_error) > 0) 
                echo "<span style='color: red;'>{$treatments_error}</span>"; ?>
        </h3>
        <h3>Beds Available: <input type="text" name="beds" required
            value="<?php echo $program->getBeds(); ?>">
            <?php if (strlen($beds_error) > 0) 
                echo "<span style='color: red;'>{$beds_error}</span>"; ?>
        </h3>
        <h3>
        <input type="hidden"
            value="<?php echo $program->getProgramNo(); ?>" name="pNo"> 
        <input type="submit" value="Validate Values">
        <input type="submit" value="Save" name="save">
        <input type="submit" value="Cancel" name= "cancel">
        </h3>
    </form>
    <h3><?php
        if (strlen($name_error) > 0 || strlen($address_error) > 0 || strlen($treatments_error) > 0 || strlen($beds_error) > 0) { 
            echo "There are validation errors!";
        } else {
            echo "All fields validate - no errors!";
        }
        ?>
</body>
</html>