<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pengajuan User <?= $karyawan->nama ?> bulan <?= bulan($bulan) . ', ' . $tahun ?></title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link rel="icon" href="<?php echo base_url(); ?>assets/img/icon.png" type="image/gif">
</head>
<body onload="window.print()">
    <div class="row mt-2">
        <div class="mt-2">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex">
                            <div class="float-left">
                                <table class="table">
                                    <tr>
                                        <th class="border-0 py-0">Nama</th>
                                        <th class="border-0 py-0">:</th>
                                        <th class="border-0 py-0"><?= $karyawan->nama ?></th>
                                    </tr>
                                    <tr>
                                        <th class="border-0 py-0">OPD</th>
                                        <th class="border-0 py-0">:</th>
                                        <th class="border-0 py-0"><?= $karyawan->opd ?></th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-body">
                            <h5 class="card-title mb-4">Pengajuan Bulan : <?= bulan($bulan) . ' ' . $tahun ?></h5>
                            <table class="table table-striped table-bordered">
                            
                                <thead>
                                    <tr>
                                    <th width='15%'>No.</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Deskripsi</th>
                                    <th>OPD</th>
                                    <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                             
                                <?php foreach($pengajuan as $i => $p): ?>
                                    <tr>
                                        <td><?= ($i+1)?></td>
                                        <td><?= $p->tgl_pengajuan ?></td>
                                        <td><?= $p->deskripsi ?></td>
                                        <td><?= $p->OPD ?></td>
                                        <td><?= $p->Status ?></td>
                                     </tr>
                                <?php endforeach; ?>
                                </tbody>
                            </table>
                              
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
