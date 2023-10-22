<?php

session_start();

if(isset($_SESSION["kullanici_adi"]))
{


    echo '<div class="alert alert-success" role="alert" >
            <h1>
            Access succesfully.  You will redirect to Main  Page in 10 second </h1>
            </div>';
   
            header("Refresh: 5; url = 'http://localhost/KO/signout.html'");
    // echo  " <h3> ".$_SESSION["kullanici_adi"]." HOŞGELDİN </h3> ";
    // echo  " <h3> ".$_SESSION["email"]." </h3> ";
    
    // echo " <a href='cikis.php' style='color:red;  bacground-color:yellow;border1px solid:red padding:5px 5px;' > ÇIKIŞ YAP</a>";

}
else
{
    echo "YOU CANNOT REACH THİS PAGE .Please  login or sign in";
}


