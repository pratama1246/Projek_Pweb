<?= $this->extend('layout/header') ?>
<?= $this->section('content'); ?>
<div class="container">
    <div class="col">
        <h3 class="mt-2">Form Ubah Buku</h3>
        <form action="/buku/ubah/<?= $buku['id_buku']; ?>" method="post" class="mt-4" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="_method" value="PUT">
            <input type="hidden" name="id_buku" value="<?= $buku['id_buku']; ?>">
            <input type="hidden" name="sampulLama" value="<?= $buku['sampul']; ?>">

            <div class="row mb-3">
                <label for="judul" class="col-sm-2 col-form-label">Judul</label>
                <div class="col-sm-6">
                    <input type="text" 
                           id="judul"
                           class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" 
                           name="judul" 
                           autofocus
                           value="<?= (old('judul')) ? old('judul') : $buku['judul']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('judul'); ?>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="pengarang" class="col-sm-2 col-form-label">Pengarang</label>
                <div class="col-sm-6">
                    <input type="text" 
                           id="pengarang"
                           class="form-control <?= ($validation->hasError('pengarang')) ? 'is-invalid' : ''; ?>" 
                           name="pengarang" 
                           value="<?= (old('pengarang')) ? old('pengarang') : $buku['pengarang']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('pengarang'); ?>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
                <div class="col-sm-6">
                    <input type="text" 
                           id="penerbit"
                           class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>" 
                           name="penerbit" 
                           value="<?= (old('penerbit')) ? old('penerbit') : $buku['penerbit']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('penerbit'); ?>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="tahun" class="col-sm-2 col-form-label">Tahun Terbit</label>
                <div class="col-sm-6">
                    <input type="number" 
                           id="tahun"
                           class="form-control <?= ($validation->hasError('tahun_terbit')) ? 'is-invalid' : ''; ?>" 
                           name="tahun_terbit" 
                           value="<?= (old('tahun_terbit')) ? old('tahun_terbit') : $buku['tahun_terbit']; ?>">
                    <div class="invalid-feedback">
                        <?= $validation->getError('tahun_terbit'); ?>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
                <div class="col-sm-2">
                    <img src="/img/<?= esc($buku['sampul']); ?>" class="img-thumbnail img-preview">
                </div>
                <div class="col-sm-4">
                    <input class="form-control <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" 
                           type="file" 
                           id="sampul" 
                           name="sampul" 
                           onchange="previewImg()">
                    <div class="invalid-feedback">
                        <?= $validation->getError('sampul'); ?>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-sm-6 offset-sm-2">
                    <button type="submit" class="btn btn-primary">Ubah</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function previewImg() {
        const sampul = document.querySelector('#sampul');
        const imgPreview = document.querySelector('.img-preview');
        
        const fileSampul = new FileReader();
        fileSampul.readAsDataURL(sampul.files[0]);
        
        fileSampul.onload = function(e) {
            imgPreview.src = e.target.result;
        }
    }
</script>
<?= $this->endSection(); ?>