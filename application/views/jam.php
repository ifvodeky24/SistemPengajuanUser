<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-block">
                <h4 class="card-title float-left">Total Pengajuan</h4>
				<div class="col-xs-12 col-sm-6 ml-auto text-right mb-2">
					<div class="dropdown d-inline">
						<button class="btn btn-secondary dropdown-toggle" type="button" id="droprop-action" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<i class="fa fa-print"></i>
							Cetak Laporan
						</button>
						<div class="dropdown-menu" aria-labelledby="droprop-action">
							<a href="<?= base_url('jam/export_pdf_admin/') ?>" class="dropdown-item" target="_blank"><i class="fa fa-file-pdf-o"></i> PDF</a>
						</div>
					</div>
				</div>
                <div class="d-inline ml-auto float-right">
                    <!-- <a href="<?= base_url('karyawan/create') ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</a> -->
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                            <th class='disabled'>id</th>
                            <th>OPD</th>
                            <th width="30%">Tanggal Pengajuan</th>
                            <th>Status Pengajuan</th>
                            <th>Aksi</th>
                            <!-- <th></th> -->
                        </thead>
                        <tbody>
                            
                            <?php foreach ($pengajuan as $p): ?>
                                <tr>
                                    <td><?= $p->id ?></td>
                                    <td><?= $p->OPD ?></td>
                                    <td>
                                        <?= $p->tgl_pengajuan ?>
                                    </td>
                                    <td>
                                        <?= $p->Status ?>
                                    </td>
                                    <td>
                                    <button type="submit" class="btn btn-primary btn-block"data-toggle="modal" data-target="#exampleModal<?= $p->id ?>">Edit <i class="fa fa-save"></i></button>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-block">
                <h4 class="card-title float-left">Laporan Jumlah Pengajuan Internet Bulanan</h4>
                <div class="d-inline ml-auto float-right">
                    <!-- <a href="<?= base_url('karyawan/create') ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</a> -->
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                            <th>Bulan</th>
                            <th width="30%">Jumlah Pengajuan</th>
                            <th>Ditolak</th>
                            <th>Dikabulkan</th>
                            <!-- <th></th> -->
                        </thead>
                        <tbody>
                            
                            <?php foreach ($pengajuan as $p): ?>
                                <tr>
                                    <td><?= $p->Bulan ?></td>
                                    <td>
                                        <?= $total ?>
                                    </td>
                                    <td>
                                        <?= $tolak ?>
                                    </td>
                                    <td>
                                        <?= $terima ?>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header d-block">
                <h4 class="card-title float-left">Laporan Jumlah Pengajuan Internet Berdasarkan OPD</h4>
                <div class="d-inline ml-auto float-right">
                    <!-- <a href="<?= base_url('karyawan/create') ?>" class="btn btn-success btn-sm"><i class="fa fa-plus"></i> Tambah</a> -->
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped datatable">
                        <thead>
                            <th>OPD</th>
                            <th width="30%">Jumlah Pengajuan</th>
                            <th>Diterima</th>
                            <th>Ditolak</th>
                            <!-- <th></th> -->
                        </thead>
                        <tbody>
                            
                            <?php foreach ($pengajuan as $p): ?>
                                <tr>
                                    <td><?= $p->OPD ?></td>
                                    <td>
                                        <?= $totalopd ?>
                                    </td>
                                    <td>
                                        <?= $terima ?>
                                    </td>
                                    <td>
                                        <?= $tolak ?>
                                    </td>
                                </tr>
                                <?php endforeach ?>
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->

<?php $no=0; foreach ($pengajuan as $p): $no++; ?>
<div class="modal fade" id="exampleModal<?= $p->id ?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ubah Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <?php echo form_open_multipart('jam/editstat'); ?>
          <div class="form-group">
              <input type="hidden" name="id" value="<?= $p->id ?>">
              <input type="hidden" name="nama" value="<?= $p->nama ?>">
              <input type="hidden" name="nip" value="<?= $p->nip ?>">
              <input type="hidden" name="OPD" value="<?= $p->OPD ?>">
              <input type="hidden" name="no_hp" value="<?= $p->no_hp ?>">
              <input type="hidden" name="email" value="<?= $p->email ?>">
              <input type="hidden" name="deskripsi" value="<?= $p->deskripsi ?>">
              <input type="hidden" name="surat" value="<?= $p->surat ?>">
              <input type="hidden" name="tgl_pengajuan" value="<?= $p->tgl_pengajuan ?>">
              <input type="hidden" name="Bulan" value="<?= $p->Bulan ?>">
              <!-- <input type="hidden" name="id" value="<?= $p->id ?>"> -->
              <label for="exampleSelectBorder">Status<code></code></label>
        <select class="custom-select form-control-border" id="exampleSelectBorder" name="stat">                          
        <option value="" selected><?= $p->Status ?></option>
        <?php foreach ($stat as $s): ?>
        <option value="<?= $s->status ?>"><?= $s->status ?></option>
        <?php endforeach ?>  
        </select>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Save changes</button>
        <?php echo form_close() ?>
      </div>
    </div>
  </div>
</div>
<?php endforeach ?>
