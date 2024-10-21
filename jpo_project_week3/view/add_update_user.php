<?php
    require_once('../controller/user.php');
    require_once('../controller/user_controller.php');
    require_once('../validation.php');

    //default person for add - empty strings and first role 
    //in list
    $user = new User('', '', '', '', date('Y-m-d'), '', '', ''); 
    $user->setUserNo(-1);
    $pageTitle = "Add a New User";

    //Retrieve the personNo from the query string and 
    //and use it to create a person object for that pNo 
    if (isset($_GET['uNo'])) {
        $user =
            UserController::getUser($_GET['uNo']);
        $pageTitle = "Update an Existing User";
    }

    if (isset($_POST['save'])) {
        //save button - perform add or update
        //roleOptions are 1, 2, 3...the $roles array is base 
        //0 index, so subtract 1 from the selected option to 
        //get the correct index
        $user = new User($_POST['userId'],$_POST['password'],$_POST['fName'], $_POST['lName'],
            $_POST['hireDate'], $_POST['eMail'], $_POST['extension'], $_POST['userLevelNo']);
        $user->setUserNo($_POST['uNo']);

        if ($user->getUserNo() === '-1') {
            //add
            UserController::addUser($user);
        } else {
            //update
            UserController::updateUser($user);
        }

        //return to people list
        header('Location: ./display_user.php');
    }

    if (isset($_POST['cancel'])) {
    //cancel button - just go back to list 
    header('Location: ./display_user.php');
    }

    //----------------------------------------------------------------------
    //VALIDATION
    //Declare and clear variables
    $userId = '';
    $password = '';
    $fName = '';
    $lName = '';
    $hireDate = '';
    $eMail = '';
    $extension = '';
    $userLevelNo = '';


    //Declare and clear variables for error messages
    $userId_error = '';
    $password_error = '';
    $fName_error = '';
    $lName_error = '';
    $hireDate_error = '';
    $eMail_error = '';
    $extension_error = '';
    $userLeverNo_error = '';

    //Retrieve values from query string and store in a local variable 
    //as long as the query string exists (which it does not on first 
    //load of a page).
    if (isset($_POST['userId'])) 
        $fName = $_POST['userId'];

    if (isset($_POST['password'])) 
        $fName = $_POST['password'];
 
    if (isset($_POST['fName'])) 
        $fName = $_POST['fName'];

    if (isset($_POST['lName'])) 
        $lName = $_POST['lName'];

    if (isset($_POST['hireDate'])) 
        $city = $_POST['hireDate'];

    if (isset($_POST['eMail'])) 
        $state = $_POST['eMail'];

    if (isset($_POST['extension'])) 
        $notes = $_POST['extension'];

    if (isset($_POST['userLevelNo'])) 
        $phone = $_POST['userLevelNo'];

    //Validate the values entered
    //Call stringLengthValidation from the Validation namespace 
    $userId_error = Validation\stringValid($userId, 7);  
    $password_error = Validation\stringValid($password, 8);  
    $fName_error = Validation\stringValid($fName, 5);  
    $lName_error = Validation\stringValid($lName, 5);  
    
    //Validation namespace numeric check
    try {
        Validation\numericValue($extension);
    }
    catch (Exception $e) {
        $extension_error = $e->getMessage();
    }
?>
<html>
<head>
    <title>JPO Programs</title>
    <link rel="stylesheet" type="text/css" href="styles.css"/> 
</head>
<body>
    <h1>JPO Programs</h1>
    <h2>Add a New User</h2>
    <form method='POST'>
        <h3>User ID: <input type="text" name="userId"
            value="<?php echo $user->getUserId(); ?>">
            <?php if (strlen($userId_error) > 0) 
                echo "<span style='color: red;'>{$userId_error}</span>"; ?>
        </h3>
        <h3>Password: <input type="text" name="password"
            value="<?php echo $user->getPassword(); ?>">
            <?php if (strlen($password_error) > 0) 
                echo "<span style='color: red;'>{$password_error}</span>"; ?>
        </h3>
        <h3>First Name: <input type="text" name="fName"
            value="<?php echo $user->getFirstName(); ?>">
            <?php if (strlen($fName_error) > 0) 
                echo "<span style='color: red;'>{$fName_error}</span>"; ?>
        </h3>
        <h3>Last Name: <input type="text" name="lName"
            value="<?php echo $user->getLastName(); ?>">
            <?php if (strlen($lName_error) > 0) 
                echo "<span style='color: red;'>{$lName_error}</span>"; ?>
        </h3>
        <h3>Hire Date: <input type="date" name="hireDate"
            value="<?php echo $user->getHireDate(); ?>">
        </h3>
        <h3>E-Mail: <input type="text" name="eMail"
            value="<?php echo $user->getEMail(); ?>">
            <?php if (strlen($eMail_error) > 0) 
                echo "<span style='color: red;'>{$eMail_error}</span>"; ?>
        </h3>
        <h3>Extension: <input type="text" name="extension"
            value="<?php echo $user->getExtension(); ?>">
            <?php if (strlen($extension_error) > 0) 
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
        </h3>
        <h3>
            <input type="hidden"
                value="<?php echo $user->getUserNo(); ?>" name="uNo"> 
            <input type="submit" value="Validate Values">
            <input type="submit" value="Save" name="save">
            <input type="submit" value="Cancel" name="cancel">
        </h3>
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