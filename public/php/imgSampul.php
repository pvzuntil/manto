<?php

if (isset($_POST['img'])) {

    $img = $_POST['img'];

    $pecah = explode(',', $img);
    $decryp = base64_decode($pecah[1]);

    $namaImg = time() . '.png';
    file_put_contents('../cropImg/' . $namaImg, $decryp);

    $koneksi = mysqli_connect('localhost', 'root', '', 'webtokov2');

    mysqli_query($koneksi, 'UPDATE tsets SET imgSampul = "/cropImg/' . $namaImg . '" WHERE idUser = ' . $_POST['idUser'] . '');

    // echo json_encode(tset::get());

    // echo $pecah[1];
}
