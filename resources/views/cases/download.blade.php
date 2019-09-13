<!DOCTYPE html>
<html lang="en">
<head>

</head>
<body>
  <h2>Laporan Pengaduan</h2>
  <br>
  <table class="table" id="tableCat" border="1" style="width: 100%">
      <thead>
        <tr>
          <th width="10%">No.</th>
          <th>Judul</th>
          <th>Diadukan Oleh</th>
          <th>Status Pengaduan</th>
          <th>Tanggal Pengaduan</th>
        </tr>
      </thead>
      <tbody>
        @if (count($data) > 0)
          @foreach ($data as $case)
            <tr>
              <td>{{$loop->index+1}}</td>
              <td>{{$case->title}}</td>
              <td>{{$case->full_name}}</td>
              <td>{{$case->case_status}}</td>
              <td>{{date('d M Y', strtotime($case->created_at))}}</td>
            </tr>
          @endforeach
        @else
        <tr>
          <td colspan="5" align="center"> Tidak ada data</td>
        </tr>
        @endif
      </tbody>
    </table>
</body>
</html>