<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Pengajuan</h4>
            </div>
            <div class="card-body">
            <?php echo form_open_multipart('Absensi/tambah_pengajuan'); ?>
                <div class="card-body">
                  <div class="form-group">
                    <label for="nip">NIP : </label>
                    <input type="hidden" name="id_user" value="<?= $this->uri->segment(3) ?>">
                    <input type="text" name="nip" id="nip" value="<?= $nip?>" class="form-control" placeholder="NIP" disabled required="reuqired" />
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Nama Lengkap</label>
                    <input type="text" class="form-control" id="exampleInputPassword1" placeholder="nama" name="nama">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">No Hp Lengkap</label>
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text">+62</span>
                        </div>
                        <input type="text" class="form-control" placeholder="No Hp" name="no_hp">
                        </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Email</label>
                    <input type="email" class="form-control" id="exampleInputPassword1" placeholder="email" name="email">
                  </div>
                  <div class="form-group">
                    <label>Deskripsi</label>
                    <textarea class="form-control" rows="3" placeholder="deskripsi" name="deskripsi"></textarea>
                    </div>                   
                <div class="form-group">
                  <label for="exampleSelectBorder">OPD<code></code></label>
                  <select class="custom-select form-control-border" id="exampleSelectBorder" name="OPD">  
                    <!-- <option>Daftar OPD</option>                   -->
                    <?php foreach ($jam as $j): ?>
                    <option value="<?= $j->nama_opd ?>"><?= $j->nama_opd ?></option>  
                    <?php endforeach; ?>
                  </select>
                </div>
                  <div class="form-group">
                    <label for="exampleInputFile">Surat Permohonan</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile" name="userfile" required>
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <!-- <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div> -->
                    </div>
                  </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              <?php echo form_close(); ?>
            </div>
        </div>
    </div>
</div>
