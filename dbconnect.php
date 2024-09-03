<?php 
// isi nama host, username mysql, dan password mysql anda
$conn = mysqli_connect("localhost","root","","inventory");

//daftar
if(isset($_POST['btn-register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $epassword = password_hash($password, PASSWORD_DEFAULT);

    $insert = mysqli_query($conn,"INSERT INTO slogin (username,password) values ('$username','$epassword')");

    if($insert){
        header('location:login.php');
    }else {
        echo'
        <script>
            alert("REGISTRASI GAGAL");
            window.location.href:"register.php";
        </script>
        ';
    }
}
// login
if(isset($_POST['btn-login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];


    $cekdb = mysqli_query($conn,"SELECT * FROM slogin WHERE username='$username'");
    $hitung = mysqli_num_rows($cekdb);
    $pw = mysqli_fetch_array($cekdb);
    $passwordsekarang = $pw['password'];

    if($hitung>0){
        if(password_verify($password,$passwordsekarang)){
            header('location:stock/stock.php');
        }else{
            echo'
            <script>
                alert("password salah");
                window.location.href:"register.php";
            </script>
            ';
        }
    }else {
        echo'
        <script>
            alert("login GAGAL");
            window.location.href:"register.php";
        </script>
        ';
    }
}

?>