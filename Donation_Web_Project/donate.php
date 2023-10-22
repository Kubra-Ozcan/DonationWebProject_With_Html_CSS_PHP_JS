<?php
   include("baglanti.php");

    $username_err = "";
    $password_err = "";
    $passwordtkr_err= "";
    $email_err = "";
    $lastname_err ="";
    $address_err="";
    $phone_err ="";
    $message="";
    $agree_err ="";

if (isset($_POST["kaydet"])) {
    //kullanıcı adı doğrulama
    if (empty(($_POST["FirstName"])))
    {
        $username_err = "Kullanıcı adı boş bırakılamaz.";
    }
    else if (strlen($_POST["FirstName"]) < 5) 
    {
        $username_err = "Kullanıcı adı en az 5 karakterden oluşmalıdır";
    }
    else 
    {
        $name = $_POST["FirstName"];
    }


    if (empty(($_POST["LastName"])))
    {
        $lastname_err = "Kullanıcı adı boş bırakılamaz.";
    }
    //  else if (strlen($_POST["LastName"]) < 5) 
    // {
    //     $lastname_err = "Kullanıcı adı en az 5 karakterden oluşmalıdır";
    // }
    else 
    {
        $lastname = $_POST["LastName"];
    }

    

    //Email doğrulama
    if (empty(($_POST["Email"])))
    {
        $email_err = "Email alanı boş bırakılamaz.";
    } 
    else 
    {
        $email = $_POST["Email"];
    }
    //Email doğrulama
    if (empty(($_POST["agree"])))
    {
        $agree_err = "Fill the blank";
    } 
    else 
    {
        $agree = $_POST["agree"];
    }



    if (empty(($_POST["PhoneNumber"])))
    {
        $phone_err = "Kullanıcı adı boş bırakılamaz.";
    }
    else 
    {
        $phone = $_POST["PhoneNumber"];
    }


    if (empty(($_POST["Address"])))
    {
        $address_err="Address boş bırakılamaz.";
    }
     
    else 
    {
        $address = $_POST["Address"];
    }


    //parola doğrulama
    if (empty(($_POST["password"]))) {
        $password_err = "Parola boş bırakılamaz.";
    }
    else 
    {
        $password = password_hash($_POST["password"],PASSWORD_DEFAULT);
    }

    //parola2 doğrulama
    if (empty(($_POST["password2"]))) 
    {
        $passwordtkr_err = "Parola tekrarı boş bırakılamaz.";
    } 
    elseif ($_POST["password"] != $_POST["password2"]) 
    {
        $passwordtkr_err= "Parolalar aynı değil.";
    } 
    else 
    {
        $password2 = $_POST["password2"];
    }




    if(!empty($_FILES['image']['name'])) // tipi text olanlara $_ ile  ulaşıyorak tipi ifile olanlara da $_ ile ulaşıyoruz
    { 
	
        // Get file info 
        $fileName = basename($_FILES["image"]["name"]); //name resmin ismini verir.
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
  
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes))
        {
          					
        $image = $_FILES['image']['tmp_name'];//    resmin geçici adını verir otomatik parametreler
        
        $imgContent = addslashes(file_get_contents($image));
        
	    }
        else
        {
            echo '<div class="alert alert-success" role="alert" style="font-size:80px; , text-align:center;,  height:4px;,
            width: 83px;, text-color:gold;">
            Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload
            </div>';
            // $message = "Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.";
            
            // print( 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.' );
            // // die();
        }
    }   
    else
    { 
        echo '<div class="alert alert-success" role="alert" style="font-size:80px; , text-align:center;,  height:4px;,
            width: 83px;, text-color:gold;">
            Please select an image file to upload.
            </div>';
        // $message = "Please select an image file to upload.";
          
    }	
	

    if (isset($name)  && isset($lastname) && isset($image) && isset($password) && isset($email )&& isset($phone) && isset($address) )
    {

        $ekle = "INSERT INTO donate (FirstName,LastName,image,password,Email,PhoneNum,Address) values ('$name','$lastname','$imgContent',
        '$password','$email','$phone','$address') ";

        $calistirekle = mysqli_query($baglanti, $ekle);

        if ($calistirekle) {
            echo '<div class="alert alert-success" role="alert" style="font-size:80px; , text-align:center;,  height:4px;,
            width: 83px;, text-color:gold;">
            Donation added successfully. 
            </div>';
            echo '<div class="alert alert-success" role="alert" >
            <h1> You will redirect to "Main Page" page in 10 second </h1>
            </div>';
   
            header("Refresh: 5; url = 'http://localhost/KO/proje.html'");
        } 
        
        else
        {
            echo '<div class="alert alert-danger" role="alert">
               ERROR: Could not able to execute $ekle .
                </div>';
        }
             
             
        //      else {
        //     echo '<div class="alert alert-danger" role="alert">
        //     ERROR: Could not able to execute $ekle .
        //     </div>';
        // }

    mysqli_close($baglanti);
    }
}
?>




<html>
   
   <head>
      <title>Insert Students Contacts Information</title>
    <link rel="stylesheet" href="insertlogin.css">
      
   </head>
   
   <body bgcolor = "#FFFFFF">


            <form action="donate.php" method = "post" enctype="multipart/form-data">
            <div class="wrapper">
                    <div class="title">Donation Form
                    </div>
                    <div class="form">
                    <div class="inputfield">
                        <label>First Name:</label><input type="text"  name="FirstName" class="input">
                    </div>  
                        <div class="inputfield">
                        <label>Last Name:</label><input type="text" name = "LastName" class="input">
                    </div>  
                    <div class="inputfield">
                        <label>Select Image File:</label><input type="file" name="image">
                        
                    </div>  
                    <div class="inputfield">
                        <label>Password</label><input type="password" name="password" class="input">
                    </div>  
                    <div class="inputfield">
                        <label>Confirm Password</label><input type="password" name="password2" class="input">
                    </div> 
                        <div class="inputfield">
                        <label>Gender</label>
                        <div class="custom_select" name=>
                            <select>
                            <option value="">Select</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            </select>
                        </div>
                    </div> 
                        <div class="inputfield">
                        <label>Email Address</label><input type="text" name="Email" class="input">
                    </div> 
                    <div class="inputfield">
                        <label>Phone Number</label><input type="text" name = "PhoneNumber"  class="input">
                    </div> 
                    <div class="inputfield">
                        <label>Address</label><textarea class="textarea"  name = "Address"></textarea>
                    </div> 

                    <div class="inputfield terms" name="agree">
                        <label class="check">
                            <input type="checkbox">
                            <span class="checkmark"></span>
                        </label>
                        <p>Agreed to terms and conditions</p>
                    </div> 
                   
                    <div class="inputfield">
                        <input type="submit" value="Be Donate"  name="kaydet" class="btn">
                    </div>
                    </div>
                </div>
            
            </form>
            <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $message; ?></div>
            </div>
			
      </div>

   </body>
</html>