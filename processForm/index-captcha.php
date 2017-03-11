<?php
// Session start must be the first line, whether you include it or not :)
session_start();
if(empty($_POST))
{
    echo '<script type="text/javascript" src="jquery-1.8.0.min.js"></script>
   <script type="text/javascript">
$(document).ready(function(){
$("#new").click(function() {
$("#captcha").attr("src", "captcha.php?"+Math.random());
});    
});
</script>
<form method="post" action="">
<span style="float: left;margin-top: 7px;margin-right:10px;">CAPTCHA Code:</span>
<img src="captcha.php" border="0" alt="CAPTCHA!" id="captcha"><a href="#new" id="new"><img src="reload.png" style="width: 35px;margin-left:10px;" /></a>
<br />
Enter CAPTCHA: <input type="text" name="captcha-key" value="" />
<br /><br />
<input type="submit" value=" Verify Captcha " />
</form>';
}
else
{
    if(strlen($_SESSION['key']) && $_POST['captcha-key'] == $_SESSION['key'])
    {
        echo "Captcha Verified!!!";
        echo '<br />';
        echo $_SESSION['key'];
    }
    else
    {
        echo "Invalid Captcha.... <a href='index.php'>try again</a>";
    }
}
?>