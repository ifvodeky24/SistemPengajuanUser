<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Total Pengajuan</title>
	<link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
	<link rel="icon" href="<?php echo base_url(); ?>assets/img/icon.png" type="image/gif">
</head>
<body onload="window.print()">
<div class="row mt-2">
	<div class="mt-2">
		<div class="row">
			<div class="col-12">
				<div class="card">
					<div class="card-body">
						<h5 class="card-title mb-4">Total Pengajuan</h5>
						<table class="table table-striped datatable">
							<thead>
							<tr>
								<th class='disabled'>id</th>
								<th>OPD</th>
								<th width="30%">Tanggal Pengajuan</th>
								<th>Status Pengajuan</th>
							</tr>
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
								</tr>
							<?php endforeach ?>

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
