<?= $this->extend('layout/header')?>
<?= $this->section('content')?>
<div class="container">
    <div class="col">
        <h3 class="mt-2">Form Tambah Buku </h3>
        <form action="/buku/simpan" method="post" class="mt-4" enctype="multipart/form-data">
            <?= csrf_field(); ?>

            <div class="row mb-3">
                <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-6">
                    <input type="text" 
                           id="judul"
                           class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid':'';?>" 
                           name="judul" 
                           autofocus
                           value="<?= old('judul'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('judul');?>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                <div class="col-sm-6">
                    <input type="text" 
                           id="pengarang"
                           class="form-control <?= ($validation->hasError('pengarang')) ? 'is-invalid':'';?>" 
                           name="pengarang" 
                           value="<?= old('pengarang'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('pengarang');?>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                <div class="col-sm-6">
                    <input type="text" 
                           id="penerbit"
                           class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid':'';?>" 
                           name="penerbit" 
                           value="<?= old('penerbit'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('penerbit');?>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="tahun" class="col-sm-2 col-form-label">Tahun Terbit</label>
                <div class="col-sm-6">
                    <input type="text" 
                           id="tahun"
                           class="form-control <?= ($validation->hasError('tahun_terbit')) ? 'is-invalid':'';?>" 
                           name="tahun_terbit" 
                           value="<?= old('tahun_terbit'); ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('tahun_terbit');?>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                <div class="col-sm-6">
                    <input type="file" 
                           id="sampul"
                           class="form-control <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>"
                           name="sampul">
                    <div class="invalid-feedback">
                        <?= $validation->getError('sampul'); ?>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Tambah</button>
                </div>
            </div>
        </form>
    </div>
</div>
<?= $this->endSection(); ?>