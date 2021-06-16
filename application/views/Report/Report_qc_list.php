<!-- load css selectize-->
<!-- tempatkan code ini pada top page view-->

<?php echo _css('datatables,icheck,selectize,multiselect') ?>
<div class='col-md-12 col-xl-12'>
	<div class="card">
		<div class="card-status bg-green"></div>
		<div class="card-header">
			<h3 class="card-title">FILTER
			</h3>
			<div class="card-options">
				<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
				<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
			</div>
		</div>
		<div class="card-body">
			<div class='box-body' id='box-table'>

				<form id='form-a' methode="GET">

					<div class='col-md-6 col-xl-6'>
						<div class='form-group'>
							<label class='form-label'>Mulai Dari</label>
							<input type='date' min="" max="<?php echo date('Y-m-d'); ?>" class='form-control data-sending focus-color' id='id_reason' name='start' value='<?php if (isset($_GET['start'])) echo $_GET['start'] ?>'>
						</div>
					</div>
					<div class='col-md-6 col-xl-6'>
						<div class='form-group'>
							<label class='form-label'>Sampai </label>
							<input type='date' min="<?php echo date("Y-m-d", strtotime("-" . (date('d') + 15) . " days")); ?>" max="<?php echo date('Y-m-d'); ?>" class='form-control data-sending focus-color' id='id_reason' name='end' value='<?php if (isset($_GET['end'])) echo $_GET['end'] ?>'>
						</div>
					</div>
					<div class='col-md-6 col-xl-6'>
						<div class='form-group'>
							<label class='form-label'>Agent </label>
							<select name='agentid[]' id="agentid" class="form-control custom-select" multiple="multiple">
								<?php
								if ($user_categori != 8) {
								?>
									<option value="0">--Semua Agent--</option>
								<?php
								}
								if ($list_agent['num'] > 0) {
									foreach ($list_agent['results'] as $d_agent) {
										$selected = "";
										if (isset($_GET['agentid'])) {

											if (count($_GET['agentid']) > 1) {

												foreach ($_GET['agentid'] as $k_agentid => $v_agentid) {
													if ($v_agentid == $d_agent->agentid) {
														$selected = 'selected';
													}
												}
											} else {
												$selected = ($d_agent->agentid == $_GET['agentid'][0]) ? 'selected' : '';
											}
										}
										echo "<option value='" . $d_agent->agentid . "' " . $selected . ">" . $d_agent->agentid . "-" . $d_agent->nama . "</option>";
									}
								}
								?>

							</select>
						</div>
					</div>


					<div class='col-md-12 col-xl-12'>

						<div class='form-group'>
							<button id='btn-save' type='submit' class='btn btn-primary'><i class="fe fe-save"></i> Search</button>
						</div>

					</div>
				</form>

			</div>
		</div>
	</div>
</div>
<?php

if (isset($_GET['start']) && isset($_GET['end'])) {


?>

	<div class='col-md-12 col-xl-12'>
		<div class="card">
			<div class="card-status bg-orange"></div>
			<div class="card-header">
				<h3 class="card-title">Report QC Periode <?php echo $_GET['start'] . " sd " . $_GET['start'] ?>

				</h3>
				<div class="card-options">
					<a href="#" class="card-options-collapse " data-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a>
					<a href="#" class="card-options-fullscreen " data-toggle="card-fullscreen"><i class="fe fe-maximize"></i></a>
				</div>
			</div>
			<div class="card-body">
				<table width="100%">
					<tr>
						<td width="50%">

						</td>
						<td width="50%">

						</td>
					</tr>
				</table>


				<div class='box-body table-responsive' id='box-table'>
					<small>
						<table class='table' id="report_table_reg">
							<thead>
								<tr>
									<th>No.</th>
									<th>TGL</th>
									<th>QCO</th>
									<th>AGENT ID</th>
									<th>PSTN</th>
									<th>REASON</th>
									<th>KATEGORI JARINGAN</th>
									<th>KETERANGAN PAKET</th>
									<th>LETAK REKAMAAN</th>
									<th>STATUS</th>
									<th>DURASI</th>
									<th>REKOMEDASI</th>
									<th>PENANGGUNG JAWAB</th>
									<th>KETERANGAN</th>
								</tr>
							</thead>
							<tbody>
								<?php
								$no = 1;
								if ($data_result > 0) {

									foreach ($data_result as $row) {
										$ket_qc = explode(';', $row['ket']);
										$eksisting=substr($row['reason'],-9);
										$ageree2='EKSISTING';
										if($eksisting != 'eksisting'){
											$ageree2='FIBER';
										}
								?>
										<tr>
											<td><?php echo $no; ?></td>
											<td style="text-align:left;" nowrap><?php echo $row['tgl_qco1']; ?></td>
											<td style="text-align:left;" nowrap><?php echo $row['nama_qco']; ?></td>
											<td style="text-align:left;" nowrap><?php echo $row['nama_agent']; ?></td>
											<td><?php echo $row['fastel']; ?></td>
											<td><?php echo $row['kategori'] . " : " . $row['reason']; ?></td>
											<td><?php echo $ageree2; ?></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
											<td></td>
										</tr>
								<?php
										$no++;
									}
								}

								?>

							</tbody>
						</table>
					</small>
				</div>
			</div>
		</div>
	</div>

<?php
}

?>

<!-- load library selectize -->
<!-- tempatkan code ini pada akhir code html sebelum masuk tag script-->

<?php echo _js('ybs,selectize,datatables,icheck,multiselect') ?>

<script type="text/javascript">
	$(document).ready(function() {
		$('#agentid').selectize({});
		$("#report_table_reg").DataTable({
			dom: 'Bfrtip',
			buttons: [
				'copy', 'csv', 'excel', 'pdf'
			]
		});
	});
</script>