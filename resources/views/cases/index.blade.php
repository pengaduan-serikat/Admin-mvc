@extends('layouts.admin')

@section('content')
{{-- <h2>ini dari user index</h2> --}}
<h2><strong>Data Pengaduan:</strong></h2>

<table class="table" id="tableCat">
  <thead>
    <th width="10%">No.</th>
    <th>Judul</th>
    <th>Diadukan Oleh</th>
    <th>Status Pengaduan</th>
    <th>Action</th>
  </thead>
  <tbody>
    @if (count($cases) > 0)
      @foreach ($cases as $case)
        <tr>
          <td>{{$loop->index+1}}</td>
          <td>{{$case->title}}</td>
          <td>{{$case->full_name}}</td>
          <td>{{$case->case_status}}</td>

          <td><a href="/cases{{$case->id}}">Edit</a>
          </td>
        </tr>
      @endforeach
    @else
    <tr>
      <td colspan="5" align="center"> Tidak ada data</td>
    </tr>
    @endif
  </tbody>
</table>
@endsection