
<?php
   include("baglanti.php");

    $username_err = "";
    $password_err = "";
    // $passwordtkr_err= "";
    // $email_err = "";

if (isset($_POST["giris"])) {
    //kullanıcı adı doğrulama
    if (empty(($_POST["kullaniciadi"])))
    {
        $username_err = "Kullanıcı adı boş bırakılamaz.";
    }
    //  else if (strlen($_POST["kullaniciadi"]) < 5) 
    // {
    //     $username_err = "Kullanıcı adı en az 5 karakterden oluşmalıdır";
    // }
    // else if (!preg_match('/^[a-z\d_]{8,25}$/i', $_POST["kullaniciadi"])) 
    // {
    //     $username_err = "Kullanıcı adı büyük küçük harf ve rakamdan oluşmalıdır";
    // } 
    else 
    {
        $name = $_POST["kullaniciadi"];
    }

    // //Email doğrulama
    // if (empty(($_POST["email"])))
    // {
    //     $email_err = "Email alanı boş bırakılamaz.";
    // } 
    // else 
    // {
    //     $email = $_POST["email"];
    // }

    //parola doğrulama
    if (empty(($_POST["password"]))) 
    {
        $password_err = "Parola boş bırakılamaz.";
    }
    else 
    {
        $password = $_POST["password"];
        // $password = password_hash($_POST["password"],PASSWORD_DEFAULT);
    }
    

    // //parola2 doğrulama
    // if (empty(($_POST["password2"]))) {
    //     $passwordtkr_err = "Parola tekrarı boş bırakılamaz.";
    // } elseif ($_POST["password"] != $_POST["password2"]) {
    //     $passwordtkr_err= "Parolalar aynı değil.";
    // } else {
    //     $password2 = $_POST["password2"];
    // }
    if (isset($name)  && isset($password)) 
    {

        $secim="SELECT * FROM kullanicilar WHERE kullanici_adi='$name' ";
        $calistir=mysqli_query($baglanti,$secim);
        $kayitsayisi=mysqli_num_rows($calistir);// ya sıfır ya birdir 1-0 

        if($kayitsayisi >0)
        {
            $ilgilikayit=mysqli_fetch_assoc($calistir);
            $hashlisifre=$ilgilikayit ["parola"];

            if(password_verify($password,$hashlisifre))
            {
                session_start();
                $_SESSION["kullanici_adi"]=$ilgilikayit["kullanici_adi"];
                $_SESSION["email"]=$ilgilikayit["email"];
                header("location:profile.php");
            }
            else
            {
                echo '<div class="alert alert-danger" role="alert">
                Password is wrong.
                </div>';
            }
        }
        else
        {
            echo '<div class="alert alert-danger" role="alert">
            Username is wrong.
            </div>';   
        }
        

        // $ekle = "INSERT INTO kullanicilar (kullanici_adi,parola) VALUES ('$name',''$password') ";

        // $calistirekle = mysqli_query($baglanti,$ekle);

        // if ($calistirekle) {
        //     echo '<div class="alert alert-success" role="alert">
        //     Kayıt başarılı bir şekilde eklendi.
        //     </div>';
        // }
        //  else 
        //  {
        //     echo '<div class="alert alert-danger" role="alert">
        //     Kayıt sırasında  beklenmedik bir hatayla karşılaşıldı
        //     </div>';
        // }

          mysqli_close($baglanti);
    }

    // if (isset($name) && isset($email) && isset($password) ){

    //     $ekle = "INSERT INTO kullanicilar (kullanici_adi,email,parola) values ('$name','$email','$password') ";

    //     $calistirekle = mysqli_query($baglanti, $ekle);

    //     if ($calistirekle) {
    //         echo '<div class="alert alert-success" role="alert">
    //         Kayıt başarılı bir şekilde eklendi.
    //         </div>';
    //     } else {
    //         echo '<div class="alert alert-danger" role="alert">
    //         Kayıt Eklenirken bir problem oluştu.
    //         </div>';
    //     }

    //     mysqli_close($baglanti);
    // }
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
        <form action="login1.php" method="POST">
                 
            <div class="title">LOGIN</div>
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
            <!-- <div class="input-box">                
                <input type="email" placeholder="Enter your Email ..." required class="form-control " name="email" >
                <div class="underline"></div>
                <div class="invalid-feedback">
               
                </div>
            </div> -->
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
            <!-- <br>
            <div class="input-box">
                
                <input type="password" placeholder="Again Enter your Password..." required class="form-control " id="exampleInputPassword1" name="password2">
                <div class="underline"></div>
                <div class="invalid-feedback">
               -->
                <!-- </div> -->
            <!-- </div> --> 
            <br>
            <button type="submit" name="giris" class="button">LOGIN</button>
            <!-- <button class="button" <a href="LabProject.html"></a>> Go To the  Website</button> -->
            <div class="github">
              <a href="kayit.php"> <p>SIGNIN</p>  </a>              
            </div>            
                  
        </form>
        </div>
        
    </div>
    
</body>
</html>




