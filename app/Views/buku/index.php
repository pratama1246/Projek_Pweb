<?= $this->extend('layout/header'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h1 class="mt-2">Daftar Buku</h1>
            <form action="" method="post">
            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Masukkan Pencarian Data Buku" aria-describedby="button-addon2" name="cari">
                <button class="btn btn-outline-secondary" type="submit" id="button-addon2">Cari</button>
            </div>
            </form>
            <?php if(session()->getFlashdata('pesan')): ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('pesan'); ?>
            </div>
            <?php endif; ?>
            <a href="/buku/tambah" class="btn btn-primary mb-3">Tambah Data Buku</a>
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Sampul</th>
                        <th scope="col">Judul</th>
                        <th scope="col">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i=1 + (2 * ($current - 1)); // ubah 3
                    foreach($buku as $b): ?>
                    <tr>
                        <th scope="row"><?= $i++; ?></th>
                        <td><img src="/img/<?= $b['sampul']; ?>" alt="Sampul Buku" width="75"></td>
                        <td><?= $b['judul']; ?></td>
                        <td><a href="/buku/<?= $b['id_buku']; ?>" class="btn btn-success">Detail</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $pager->links('buku', 'page_buku'); // ubah 4 ?>
        </div>
    </div>
</div>
<?= $this->endSection(''); ?>