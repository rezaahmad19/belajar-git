<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h2>SI Sekolah | Data Siswa</h2>
    <br>
    <a href="tambah.php">Tambah Data</a>
    <br>
    <table border="1">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>NIM</th>
            <th>Alamat</th>
            <th>Opsi</th>
        </tr>
        <?php
        include 'koneksi.php';
        $no = 1;
        $query = mysqli_query($conn,"SELECT * from siswa");
        while ($data = mysqli_fetch_array($query)) {
            ?>
        <tr>
            <td><?php echo $no++ ?></td>
            <td><?php echo $data['nama'];?></td>
            <td><?php echo $data['nim'];?></td>
            <td><?php echo $data['alamat'];?></td>
            <td>
                <a href="edit.php?id=<?php echo $data['id'];?>">EDIT</a> |
                <a href="hapus.php?id=<?php echo $data['id'];?>">HAPUS</a>
            </td>
        </tr>
        <?php
        }
        ?>
    </table>
</body>
</html>