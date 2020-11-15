<?php 

    function compress($source, $destination, $quality) {
        $info = getimagesize($source);
        if ($info['mime'] == 'image/jpeg') 
            $image = imagecreatefromjpeg($source);
        elseif ($info['mime'] == 'image/gif') 
            $image = imagecreatefromgif($source);
        elseif ($info['mime'] == 'image/png') 
            $image = imagecreatefrompng($source);
        imagejpeg($image, $destination, $quality);
        return $destination;
    }
    
    function upload()
    {

        $namaFile = $_FILES['gambar']['name'];
        $ukuranFile = $_FILES['gambar']['size'];
        $error = $_FILES['gambar']['error'];
        $tmpName = $_FILES['gambar']['tmp_name'];
        $source_properties = getimagesize($tmpName);
        
        // cek apakah tidak ada gambar yang diupload
        if ($error === 4) {
            echo "<div class='alert alert-warning  show alert-dismissible mt-2'>
                    Pilih gambar terlebih dahulu!
                </div>";	
            // echo "<script>
            //             alert('Pilih gambar terlebih dahulu!');
            //          </script>";
            return false;
        };

        // cek apakah yang diupload adalah gambar
        $ekstensiGambarValid = ['jpg', 'jpeg', 'png'];
        $ekstensiGambar = explode('.', $namaFile);
        $ekstensiGambar = strtolower(end($ekstensiGambar));
        if (!in_array($ekstensiGambar, $ekstensiGambarValid)) {
            echo "<div class='alert alert-warning  show alert-dismissible mt-2'>
                    Yang anda upload bukan gambar!
                </div>";
            // echo "<script>
            //             alert('yang anda upload bukan gambar!');
            //          </script>";
            return false;
        }

        // cek ika ukurannya terlalu besar 
        if ($ukuranFile > 1000000) {
            echo "<div class='alert alert-warning  show alert-dismissible mt-2'>
                    Ukuran gambar terlalu besar!
                </div>";
            // echo "<script>
            //             alert('ukuran gambar terlalu besar!');
            //          </script>";
            return false;
        }

        // jika lolos pengecekan, gambar siap diupload
        // generate nama gambar baru
        $namaFileBaru = uniqid();
        $namaFileBaru .= '.';
        $namaFileBaru .= $ekstensiGambar;
        $destination_img = 'img/' . $namaFileBaru;
        compress($tmpName, $destination_img, 65);
        // move_uploaded_file($tmpName, 'img/' . $namaFileBaru);


        return $namaFileBaru;
    }

    function hapus_gambar($file) {
        // unlink('img/'.$file);
        $filePath = 'img/'.$file;
        if (file_exists($filePath)) 
        {
            unlink($filePath);
        }
    }

?>