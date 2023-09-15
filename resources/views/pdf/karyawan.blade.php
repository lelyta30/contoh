<!DOCTYPE html>
<html>
<head>
	<title>Data Karyawan</title>
	<style type="text/css">
		.center{
			text-align: center;
		}
		.full{
			width: 100%;
		}
		.wrapper{
			padding-left: 30px;
			padding-right: 30px;
		}
		.underline{
			text-decoration: underline;
		}
		.bt-1{
			border-top: 2px solid black;
		}
		.bb-1{
			border-bottom: 2px solid black;
		}
		.mt-1{
			margin-top: 5px;
		}
		.mb-1{
			margin-bottom: 5px;
		}
		table tr th,table tr td{
			text-align: left;
		}
	</style>
</head>
<body>
	<div class="center full">
		<h2 class="underline">Data Diri Karyawan</h2>
	</div>

	<div class="wrapper">
		<strong>Personal Data</strong>
		<div class="bt-1 bb-1">
			<div class="full">
				<div style="display: inline-block;width: 460px;">
					<table class="full mt-1 mb-1" style="margin-top: 50px;">
						<tr>
							<th width="100">Nama Lengkap :</th>
							<td>{{$karyawan->nama}}</td>
						</tr>
						<tr>
							<th>merk_comm_device :</th>
							<td>{{$karyawan->merk_comm_device}}</td>
						</tr>
						<tr>
							<th>MERK METER :</th>
							<td>{{$karyawan->merk_meter}}</td>
						</tr>
						<tr>
							<th>Telp :</th>
							<td>{{$karyawan->telp}}</td>
						</tr>
						<tr>
							<th>provider :</th>
							<td>{{$karyawan->provider}}</td>
						</tr>
						<tr>
							<th>Divisi</th>
							<td>{{$karyawan->nama_organisasi}}</td>
						</tr>
					</table>
				</div>
				<?php
				$ip_address = storage_path('app/ip_address/2345678909876543.png');
				if($karyawan->ip_address!=null) $ip_address = storage_path('app/'.$karyawan->ip_address);
				?>
				<img style="width: 150px;margin-top:5px;border: 1px solid lightgray;display: inline-block;float: right;" src="{{$ip_address}}">
			</div>
		</div>
	</div>
</body>
</html>