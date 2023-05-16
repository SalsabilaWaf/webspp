<?php include 'koneksi.php';

if(isset($_POST['id_siswa'])) {
    $id_siswa = $_POST['id_siswa'];
    $query = "SELECT siswa.*, angkatan.*, jurusan.*, kelas.* FROM siswa,angkatan,jurusan,kelas WHERE siswa.
        id_angkatan = angkatan.id_angkatan AND siswa.id_jurusan = jurusan.id_jurusan AND siswa.id_kelas =
        kelas.id_kelas and siswa.id_siswa = $id_siswa";
    $exec = mysqli_query($conn,$query);
    $res = mysqli_fetch_assoc($exec);
    ?>

    <form action="editdatasiswa.php" method="POST">
        <input type="hidden" name="id_siswa" value="<?= $res['id_siswa'] ?>">
        <input type="hidden" name="nisn" disabled="" value="<?= $res['nisn'] ?>">
        <input type="text" class="form-control mb-2" name="" disabled="" value="<?= $res['nisn'] ?>">
        <input type="text" class="form-control mb-2" name="nama" disabled="" value="<?= $res['nama'] ?>">
        <select class="form-control mb-2" name="id_angkatan">
            <option selected="">-Pilih Angkatan-</option>
            <?php
            $selected="";
            $exec = mysqli_query($conn,"SELECT * FROM angkatan order by id_angkatan");
            while ($angkatan = mysqli_fetch_assoc($exec)) :
                if($res['id_angkatan'] == $angkatan['id_angkatan']) {
                    $selected = 'selected';
                }else {
                    $selected="";
                }
                echo "<option $selected value=".$angkatan['id_angkatan'].">".$angkatan['nama_angkatan
                ']."</option";
            endwhile;
            ?>
            </select>
            <select class="form-control mb-2" name="id_kelas">
                <option selected="">-Pilih Kelas-</option>
            <?php
                $exec = mysqli_query($conn,"SELECT *FROM kelas order by id_kelas");
                while ($angkatan = mysqli_fetch_assoc($exec)) :
                    if($res['id_kelas'] == $angkatan['id_kelas']) {
                        $selected = 'selected';
                    }else {
                        $selected="";
                    }
                    echo "<option $selected value=".$angkatan['id_kelas'].">".$angkatan['nama_kelas
                    ']."</option";
                    endwhile;
            ?>
                </select>
                <select class="from-control" name="id_jurusan">
                    <option selected="">-Pilih Jurusan-</option>
            <?php
                $exec = mysqli_query($conn,"SELECT *FROM jurusan order by id_jurusan");
                while ($angkatan = mysqli_fetch_assoc($exec)) :
                    if($res['id_jurusan'] == $angkatan['id_jurusan']) {
                        $selected = 'selected';
                    }else {
                        $selected="";
                    }
                    echo "<option $selected value=".$angkatan['id_jurusan'].">".$angkatan['nama_jurusan
                    ']."</option";
                    endwhile;
            ?>
                </select>
                <textarea class="from-control mt-2" name="alamat" placeholder="Alamat Siswa"><?= $res['
                alamat'] ?></textarea>

            </form>
        <?php }?>
