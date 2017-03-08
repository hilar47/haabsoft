<?php
session_start();
/*if(strlen($_SESSION['key']) && $_REQUEST['captcha'] == $_SESSION['key'])
    {
        echo "Captcha Verified!!!";
        echo '<br />';
        echo $_SESSION['key'];
    }
    else
    {
        echo "Invalid Captcha.... <a href='index.php'>try again</a>";
    }*/
?>

<?php

/*if(strtolower($_REQUEST['captcha']) == $_SESSION['key']) echo '1';
 else '0';*/

    $captcha = $_POST['captcha'];

    if($captcha == $_SESSION['key']){
        echo "true";
    } else {
        echo "false";
    }

?>