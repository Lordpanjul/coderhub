<?php
//cek button    
    if ($_POST['Submit'] == "Submit") {
    $email             = $_POST['email'];
    $pass              = $_POST['pass'];
    $nama              = $_POST['nama'];
    $nim               = $_POST['nim'];
    $kelas             = $_POST['kelas'];
    $telepon           = $_POST['telepon'];
    //validasi data data kosong
    if (empty($_POST['email'])||empty($_POST['pass'])||empty($_POST['nama'])||empty($_POST['nim'])||empty($_POST['kelas'])||empty($_POST['telepon'])) {
        ?>
            <script language="JavaScript">
                alert('Data Harap Dilengkapi!');
                document.location='daftar.html';
            </script>
        <?php
    }
    else {
    include "connection.php";
    $email = $_POST['email'];  
    $nim = $_POST['nim'];  
      
        //to prevent from mysqli injection  
        $nim = stripcslashes($nim); 
        $nim = mysqli_real_escape_string($con, $nim);  
      
        $sql = "select *from coderhub where nim = '$nim'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            echo "<h1><center> Data sudah Dipakai </center></h1>";  
        }  
        else{  	
    //Masukan data ke Table
    $input    ="insert into coderhub (email,pass,nama,nim,kelas,telepon) values ('$email','$pass','$nama','$nim','$kelas','$telepon')";
    $query_input =mysqli_query($con,$input);
    if ($query_input) {
    //Jika Sukses
    ?>
        <script language="JavaScript">
        alert('Input Data Mahasiswa Berhasil');
        document.location='daftar.html';
        </script>
    <?php
    }
    else {
    //Jika Gagal
    echo "Input Data Mahasiswa Gagal!, Silahkan diulangi!";
    }
//Tutup koneksi engine MySQL
    mysql_close($Open);
    }
}
}
?>