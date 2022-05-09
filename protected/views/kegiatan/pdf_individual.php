<style type="text/css">
	td {
		vertical-align: top;
	}

	th {
		vertical-align: top;
	}

	.value-rincian td {
		padding-top: 10px;
		padding-bottom: 70px;		
	}

	.value-rincian table {

		vertical-align: top;
	}
	table {
		margin-top: 50px;
	}
</style>
	


<?php $no_kompetensi=1; foreach($model->findAllKompetensi() as $kompetensi) { ?>
	
	<table width="100%" border="1" style="border-collapse: collapse" cellpadding="3">
		<tr>
			<th style="text-transform: uppercase;text-align: center" colspan="5">individual report</th>
		</tr>
			<tr>
				<th style="text-transform: uppercase">No.</th>
				<th style="text-transform: uppercase" cols}pan="2">Item</th>
			<th style="text-transform: uppercase">N</th>
			<th style="text-transform: uppercase">Grafik Individual</th>
			<th style="text-transform: uppercase">Nilai</th>
		</tr>
		<tr>
			<td rowspan="6" style="text-align: center"><?= $no_kompetensi; ?></td>
			<td colspan="2" width="20px"><?= $kompetensi->uraian; ?></td>
			<td>&nbsp;</td>		
			<th style="text-transform: uppercase">Gap:</th>
		</tr>
		<tr>
			<td style="padding: 0px;">
				<table width="100%" cellpadding="3" border="1" style="border-collapse: collapse;" class="value-rincian">
					<?php $i=1;  foreach($kompetensi->findAllRincian() as $data) { ?>
					<tr>
						<td><?= $i; ?></td>
						<td><?= $data->uraian; ?></td>
					</tr>
					<?php $i++; } ?>				
				</table>
			</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="padding: 0px;">
				<table width="100%" cellpadding="3" border="1" style="border-collapse: collapse;" class="value-rincian">
					<?php $i=1;  foreach($kompetensi->findAllRincian() as $data) { ?>
					<tr>
						<td>
							GAP:
						</td>					
					</tr>
					<?php $i++; } ?>				
				</table>
			</td>
		</tr>
	</table>

	<pagebreak> 
<?php $no_kompetensi++; } ?>