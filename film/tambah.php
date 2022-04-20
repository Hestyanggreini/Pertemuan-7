<?php  

$conn = mysqli_connect("localhost", "root", "", "film");

function upload() {
    $namaFile = $_FILES['gambar']['name'];
    $ukuranFile = $_FILES['gambar']['size'];
    $error = $_FILES['gambar']['error'];
    $tmpName = $_FILES['gambar']['tmp_name'];


    $ekstensiGambar = explode('.', $namaFile);
    $ekstensiGambar = strtolower(end($ekstensiGambar));

    // generate nama gambar baru
    $namaFileBaru = uniqid();
    $namaFileBaru .= '.';
    $namaFileBaru .= $ekstensiGambar;
    move_uploaded_file($tmpName, 'img/' . $namaFileBaru);

    return $namaFileBaru;
}

function tambah($data) {
    global $conn;

    // htmlspecialchars berfungsi untuk tidak menjalankan script
    $nama = htmlspecialchars($data["nama"]);
    $deskripsi = htmlspecialchars($data["deskripsi"]);

    $gambar = upload();


        // tambahkan ke database
        // NULL digunakan karena jika dikosongkan maka akan terjadi error di database yang sudah online
        // sedangkan jika masih di localhost, bisa memakai ''
    mysqli_query($conn, "INSERT INTO detail VALUES(NULL, '$nama', '$gambar', '$deskripsi')");
    return mysqli_affected_rows($conn);
}


if (isset($_POST["register"])) {
  
  if (tambah($_POST) > 0 ) {
     echo "<script>
        alert('Film Berhasil Ditambahkan!');
      </script>";
  } else {
    echo mysqli_error($conn);
  }

} 

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSS -->
    <link rel="stylesheet" href="css/style.css">

    <title>Tambah Data</title>
    <style>
        .btn {
            text-decoration: none;
            padding: 3px 10px;
            background-color: darkred;
        }
        #content {
            width: 100%;
        }
    </style>
</head>

<body>

   <main>
        <div id="content">
            <h2 class="judul">Formulir Tambah Biji Kopi</h2>
            <article class="card">
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="jarak">
                         <label for="nama">Nama Film</label>
                         <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Film" required>
                    </div>
                    <div class="jarak">
                         <label for="gambar">Gambar</label>
                         <input type="file" id="gambar" name="gambar" required>
                    </div>
                    <div class="jarak">
                         <label for="deskripsi">Rating</label>
                         <input type="text" id="deskripsi" rows="30"  name="deskripsi" required>
                    </div>
                    <center>
                    <button type="submit" name="register" class="btn" style="width: 50%;padding:10px;background-color: #996633;">Tambah</button>
                    </center>
                </form>
            </article>
        </div>
    </main>

</body>
</html>