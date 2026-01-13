<?php
session_start();
$_SESSION['menu'] = "dealer";
include '../includes/header.php';
include '../includes/koneksi.php';
?>

<!-- awal konten -->
<?php
if (isset($_SESSION['level'])) {

?>
    <div class="container vh-konten">
        <h1>selamat datang <b><?= $_SESSION['username']; ?></b></h1>
        <hr>
        <!-- awal tombol tambah dealer-->
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            Tambah dealer
        </button>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah dealer</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="input_dealer.php" method="post">
                            <div class="row">
                                <div class="col-lg-8">
                                    <label for="">Nama dealer</label>
                                    <input type="text" name="nama_dealer" id=""
                                        class="form-control">
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <label for="">No telepon</label>
                                        <input type="text" name="no_telp" id=""
                                        class="form-control">
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <label for="">Alamat</label>
                                            <textarea name="alamat" id=""
                                            class="form-control" style="min-height:150px; max-height:250px;"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" value="simpan dealer" class="btn btn-primary">
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- akhir tombol tambah dealer -->
        <?php
        $sql = "SELECT * FROM tb_dealer";
        $sql_eksekusi = mysqli_query($koneksi, $sql);
        ?>
        <table class="table mt-3">
            <thead class="table-dark">
                <tr>
                    <th>No</th>
                    <th>Nama dealer</th>
                    <th>no telp</th>
                    <th>alamat</th>
                    <th colspan="3">aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $nomor = 1;
                while ($data = mysqli_fetch_array($sql_eksekusi)) {

                ?>
                    <tr>
                        <td><?= $nomor++; ?></td>
                        <td><?= $data[1]; ?></td>
                        <td><?= $data[2]; ?></td>
                        <td><?= $data[3]; ?></td>
                        <td>
                            <!-- awal ubah dealer -->
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-warning"
                                data-bs-toggle="modal" data-bs-target="#modalubah<?= $nomor; ?>">
                                Ubah dealer
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modalubah<?= $nomor; ?>"
                                tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="update_dealer.php" method="post">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Ubah data <?= $data['nama_dealer'] . "| ID:" . $data['id_dealer']; ?></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="">Nama dealer</label>
                                                    <input type="hidden" name="id_dealer" value="<?= $data['id_dealer']; ?>">
                                                    <input type="text" name="nama_dealer" id="" class="form-control mt-1 " value="<?= $data['nama_dealer']; ?>">
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-6">
                                                    <label for="">No telp</label>
                                                    <input type="text" name="no_telp" id="" class="form-control mt-1"><?= $data['no_telp']; ?>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <label for="">alamat</label>
                                                    <textarea name="alamat" id="" class="form-control"><?= $data['alamat']; ?></textarea>
                                                </div>
                                            </div>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <input type="submit" value="mengubah" class="btn btn-warning">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- akhir ubah dealer -->
                            </td>
                            <td>
                        <!-- awal dealer hapus-->
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger"
                            data-bs-toggle="modal" data-bs-target="#modalhapus<?= $nomor; ?>">
                            hapus dealer
                        </button>

                        <!-- Modal hapus-->
                        <div class="modal fade" id="modalhapus<?= $nomor; ?>" 
                        tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header bg-danger text-white">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">hapus dealer</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        apakah anda nyakin mau menghapus dealer <?= $data['nama_dealer']; ?>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        <a href="hapus_dealer.php?id_dealer=<?= $data['id_dealer']; ?>" class="btn btn-danger">hapus</a>
                                    </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- akhir dealer hapus -->
                         </td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
        </table>
    </div>
<?php
} else {
?>

    <div class="container vh-konten">
        <h1>website ini adalah official dari wimcyle</h1>
    </div>

<?php
}
?>
<!-- akhir konten -->


<?php include '../includes/footer.php'; ?>

</body>

</html>
