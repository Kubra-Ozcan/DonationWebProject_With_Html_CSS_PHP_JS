<?php

$host="localhost";
$kullanici="root";  // admin paneli üzerinde değişiklik yapmadıysan babittir, geçerli sayılır
$parola="";//  admin paneline erişebilmesi için bir parola olması gerekir değişiklik  yapmadığın sürece sabittir 
$vt="uyelik";  //veritabanı ismi


$baglanti= mysqli_connect($host,$kullanici,$parola,$vt);//  sıralma çok önemliotomatik komut
mysqli_set_charset($baglanti,"UTF8");// kullanıcı girişinde otomatik olarak Türkçe  karakter girişlerini kabul etmesi içn 


// if($baglanti)
// {
    // echo "Bağlantı kuruldu ";
// }
//  kontrol için örnek kod
?>