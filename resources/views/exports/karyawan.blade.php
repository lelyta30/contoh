<table>
	<thead>
		<tr>
			<th colspan="2" rowspan="2"></th>
			<th colspan="5" style="text-align: center;"><strong>EXPORT DATA KARYAWAN</strong></th>
		</tr>
		<tr>
			<th></th>
		</tr>
		<tr>
			<th>NO</th>
			<th>ID</th>
			<th>NAME</th>
			<th>ADDRESS</th>
			<th>TARIFF</th>
			<th>DAYA</th>
			<th>N.MTR</th>
			<th>M.MTR</th>
			<th>T.MTR</th>
			<th>N.CM.DVC</th>
			<th>M.CM.DVC</th>
			<th>T.CM.DVC</th>
			<th>PORT</th>
			<th>PHONE</th>
			<th>PROVIDER</th>
			<th>IP</th>
			<th>STATUS</th>
			<th>BPJS KESEHATAN</th>
			<th>BPJS KETENAGAKERJAAN</th>
			<th>ORGANISASI_ID</th>
		</tr>
	</thead>
	<tbody>
		@foreach($list_karyawan as $karyawan)
		<tr>
			<td>{{$karyawan->index + 1}}</td>
			<td>{{$karyawan->id_pelanggan}}</td>
            <td>{{$karyawan->name}}</td>
            <td>{{$karyawan->address}}</td>
            <td>{{$karyawan->tariff}}</td>
            <td>{{$karyawan->daya}}</td>
            <td>{{$karyawan->no_meter}}</td>
            <td>{{$karyawan->merk_meter}}</td>
            <td>{{$karyawan->type_meter}}</td>
            <td>{{$karyawan->no_comm_device}}</td>
            <td>{{$karyawan->merk_comm_device}}</td>
            <td>{{$karyawan->type_comm_device}}</td>
            <td>{{$karyawan->port}}</td>
            <td>{{$karyawan->phone}}</td>
            <td>{{$karyawan->provider}}</td>
            <td>{{$karyawan->ip_address}}</td>			
			<td>{{$karyawan->status}}</td>
			<td>{{$karyawan->nomor_bpjs_kesehatan}}</td>
			<td>{{$karyawan->nomor_bpjs_ketenagakerjaan}}</td>
			<td>{{$karyawan->organisasi_id}}</td>
		</tr>
		@endforeach
	</tbody>
</table>