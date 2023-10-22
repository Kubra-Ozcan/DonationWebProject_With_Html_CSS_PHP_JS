
<?php
   include("baglanti.php");

    $username_err = "";
    $password_err = "";
    $passwordtkr_err= "";
    $email_err = "";

if (isset($_POST["kaydet"])) {
    //kullanıcı adı doğrulama
    if (empty(($_POST["kullaniciadi"])))
    {
        $username_err = "Kullanıcı adı boş bırakılamaz.";
    }
     else if (strlen($_POST["kullaniciadi"]) < 5) 
    {
        $username_err = "Kullanıcı adı en az 5 karakterden oluşmalıdır";
    }
    
    
    // else if (!preg_match('/^[a-z\d_]$/i', $_POST["kullaniciadi"])) 
    // {
    //     $username_err = "Kullanıcı adı büyük küçük harf  oluşmalıdır";
    // } 
    else 
    {
        $name = $_POST["kullaniciadi"];
    }

    //Email doğrulama
    if (empty(($_POST["email"])))
    {
        $email_err = "Email alanı boş bırakılamaz.";
    } 
    else 
    {
        $email = $_POST["email"];
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
    if (empty(($_POST["password2"]))) {
        $passwordtkr_err = "Parola tekrarı boş bırakılamaz.";
    } elseif ($_POST["password"] != $_POST["password2"]) {
        $passwordtkr_err= "Parolalar aynı değil.";
    } else {
        $password2 = $_POST["password2"];
    }

    if (isset($name) && isset($email) && isset($password) ){

        $ekle = "INSERT INTO kullanicilar (kullanici_adi,email,parola) values ('$name','$email','$password') ";

        $calistirekle = mysqli_query($baglanti, $ekle);

        if ($calistirekle) {
            echo '<div class="alert alert-success" role="alert" style="font-size:80px; , text-align:center;,  height:4px;,
            width: 83px;, text-color:gold;">
            Information added successfully. 
            </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
            ERROR: Could not able to execute $ekle .
            </div>';
        }

        mysqli_close($baglanti);
    }
}
   	
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giriş Yap</title>
    <link rel="stylesheet" type="text/css" href="kayit.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
</head>
<body>

    <div class="container p-5">
        <div class="card p-5">
        <form action="kayit.php" method="POST">
                 
            <div class="title">SIGN IN</div>
            <div class="input-box">                
                <input type="text" placeholder="Enter your username..." required class="form-control <?php 
                    if (!empty($username_err)) {
                        echo "is-invalid";
                    }
                ?>" id="exampleInputEmail1" name="kullaniciadi" >
                <div class="underline"></div>
                <div class="invalid-feedback">
                <?php
                echo $username_err;
                ?>
                </div>
            </div>            
            <br>
            <div class="input-box">                
                <input type="email" placeholder="Enter your Email ..." required class="form-control <?php 
                    if (!empty($email_err)) {
                        echo "is-invalid";
                    }
                ?>" name="email" >
                <div class="underline"></div>
                <div class="invalid-feedback">
                <?php
                echo $email_err;
                ?>
                </div>
            </div>
            <br>
            <div class="input-box">                
                <input type="password" placeholder="Enter your password ..." required class="form-control <?php 
                    if (!empty($password_err)) {
                        echo "is-invalid";
                    }
                ?>" id="exampleInputPassword1" name="password">
                <div class="underline"></div>
                <div class="invalid-feedback">
                <?php
                echo $password_err;
                ?>
                </div>
            </div>
            <br>
            <div class="input-box">
                
                <input type="password" placeholder="Again Enter your Password..." required class="form-control <?php 
                    if (!empty($passwordtkr_err)) {
                        echo "is-invalid";
                    }
                ?>" id="exampleInputPassword1" name="password2">
                <div class="underline"></div>
                <div class="invalid-feedback">
                <?php
                echo $passwordtkr_err;
                ?>
                </div>
            </div>
            <br>
            <button type="submit" name="kaydet" class="button">SIGN IN</button>
            <!-- <button class="button" <a href="LabProject.html"></a> >Go To the  Website</button> -->
            <div class="github">
              <a href="LabProject.html">Go To the  Website</a>              
            </div>            

        </form>
        </div>
        
    </div>
    
</body>
</html>