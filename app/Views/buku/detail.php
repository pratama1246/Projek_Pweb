<?= $this->extend('layout/header'); ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="row">
        <div class="col">
            <h3 class="mt-2">Detail Buku</h3>
            <div class="card mb-3" style="max-width: 540px;">
                <div class="row no-gutters">
                    <div class="col-md-4">
                        <img src="/img/<?= $buku['sampul']; ?>" class="card-img" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h5 class="card-title"><?= $buku['judul']; ?></h5>
                            <p class="card-text"><b>Pengarang : </b><?= $buku['pengarang']; ?></b></p>
                            <p class="card-text"><b>Penerbit : </b><?= $buku['penerbit']; ?></b></p>
                            <p class="card-text"><b>Tahun Terbit : </b><?= $buku['tahun_terbit']; ?></b></p>
                            <a href="/buku/ubah/<?= $buku['id_buku']; ?>" class="btn btn-warning">Ubah</a>
                            
                            <form action="/buku/<?= $buku['id_buku']; ?>" method="post" class="d-inline">
                                <?= csrf_field(); ?>
                                <input type="hidden" name="_method" value="DELETE">
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Apakah anda yakin ingin menghapus data ini?');">Hapus</button>
                            </form>
                            <br><br>
                            <a href="/buku">Kembali ke daftar buku</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?= $this->endSection(); ?>
