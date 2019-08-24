@extends('layouts.admin')

@section('content')
{{-- <h2>ini dari user index</h2> --}}
<h2><strong>Data Pengaduan:</strong></h2>

<div class="col-md-3">
    <label>Bulan</label>
  <select class="form-control" name="monthFilter" id="monthFilter">
    <option value="0">All</option>
    @foreach ($data['month'] as $month)
      <option 
        value="{{$month->value}}"
        @if ($month->value == app('request')->input('month'))
            selected          
        @endif
      >
        {{$month->name}}
      </option>
    @endforeach
  </select>
</div>

<div class="col-md-3">
    <label>Tahun</label>
  <select class="form-control" name="yearFilter" id="yearFilter">
      <option value="0">All</option>
      @foreach ($data['year'] as $year)
        <option 
          value="{{$year->value}}"
          @if ($year->value == app('request')->input('year'))
            selected          
          @endif
        >
          {{$year->name}}
        </option>
      @endforeach
  </select>
</div>

<div class="col-md-3">
  <label>Status Pengaduan</label> 
  <select class="form-control" name="caseStatus" id="caseStatus">
      <option value="0">All</option>
      @foreach ($data['case_status'] as $case_status)
        <option 
          value="{{$case_status->value}}"
          @if ($case_status->value == app('request')->input('case_status'))
            selected          
          @endif
        >
          {{$case_status->name}}
        </option>
      @endforeach
  </select>
</div>
<div class="col-md-3">
  <br />
  <a class="btn btn-primary" onclick="window.location.replace(`/cases?month=`+document.getElementById('monthFilter').value+'&year='+document.getElementById('yearFilter').value+'&case_status='+document.getElementById('caseStatus').value)">Filter</a>
</div>
<table class="table" id="tableCat">
  <thead>
    <th width="10%">No.</th>
    <th>Judul</th>
    <th>Diadukan Oleh</th>
    <th>Status Pengaduan</th>
    <th>Tanggal Pengaduan</th>
    <th>Action</th>
  </thead>
  <tbody>
    @if (count($data['cases']) > 0)
      @foreach ($data['cases'] as $case)
        <tr>
          <td>{{$loop->index+1}}</td>
          <td>{{$case->title}}</td>
          <td>{{$case->full_name}}</td>
          <td>{{$case->case_status}}</td>
          <td>{{date('d M Y', strtotime($case->created_at))}}</td>

          <td><a href="/cases/{{$case->id}}">Detail</a>
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
<span>{{$data['cases']->links()}}</span>
@endsection