<?php
use yii\helpers\Url;
use yii\helpers\Html;

// Url::base();         // /myapp
// Url::base(true);     // http(s)://example.com/myapp - depending on current schema
// Url::base('https');  // https://example.com/myapp
// Url::base('http');   // http://example.com/myapp
// Url::base(''); 
?>

<div class="container-fluid">
	<div class="row">
		<div class="col-12">
			<h5>Dashboard Persons</h5>
			<hr>
			<h6><?php echo $title ?></h6>
			<hr>
		</div>
	</div>
	<div class="row" style="">
		<div class="col-12 col-md-12">
			<div class="card text-center" style="margin-bottom: 10px">
				<div class="card-body">
					<h5 class="card-title">Tambah</h5>
					<p class="card-text">Menambah user baru</p>
					<a href="#" class="btn btn-success" id="tambahKaryawan"><i class="fas fa-plus"></i>&nbsp;Tambah</a>
				</div>
			</div>
		</div>
	</div>
	<div class="row" style="margin-top: 20px;">
		<div class="col-12 col-md-12">
			<div class="table-responsive">
				<table class="table table-striped table-bordered" style="border-bottom: none;border-top: none;" id="tableData">
					<thead>
						<th>#</th>
						<th>NIK</th>
						<th>Nama</th>
						<th>Jenis Kelamin</th>
						<th></th>
					</thead>
					<tbody>
						<?php $count = 1 ?>
						<?php foreach ($daftarPersons as $key => $value) : ?>
							<tr>
								<td><?php echo $count;
									$count++; ?></td>
								<td><?php echo $value->persons->nik ?></td>
								<td><?php echo $value->persons->nama; ?></td>
								<td>
									<?php if ($value->persons->jk == 1) : ?>
										Pria
									<?php endif ?>
									<?php if ($value->persons->jk != 1) : ?>
										Wanita
									<?php endif ?>
								</td>
								<td>
									<button class="btn btn-primary" >Info</button>
								</td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div class="modal" tabindex="-1" role="dialog" id="modalKelola">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h4 class="modal-title">Kelola Detail Karyawan</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

    document.querySelector('#tambahKaryawan').addEventListener("click", () => {
        alert('2')
    })

	$(document).ready(function() {
		$('#tableData').DataTable();
	});

    // $('#tambahKaryawan').click(event => {
    //     event.preventDefault();
    //     alert('ww')
    // })

</script>