@extends('layouts.admin')

@section('content')
<h2><strong>Form:</strong></h2>
<form method="POST" action="/cases/{{$data['case']->id}}">
  @csrf
  @method('PUT')
  <div class="row">
    <div class="col-md-6">
      <label for="reporter">Diadukan oleh</label>  
      <input 
        value="{{$data['case']->full_name}}" 
        type="text" 
        class="form-control" 
        name="reporter" 
        id="reporter" 
        placeholder="Diadukan oleh" 
        autocomplete="off" 
        required
        readonly="readonly"
        style="color: #000;"
      >
    </div>
    <div class="col-md-6">
        <label for="positions">Jabatan</label>  
        <input 
          value="{{$data['case']->position_name}}" 
          type="text" 
          class="form-control" 
          name="positions" 
          id="positions" 
          placeholder="Jabatan" 
          autocomplete="off" 
          required
          readonly="readonly"
          style="color: #000;"
        >
      </div>
  </div>
  <div class="row">
      <div class="col-md-6">
        <label for="name">Judul</label>
        <input 
          value="{{$data['case']->title}}" 
          type="text" 
          class="form-control" 
          name="title" 
          id="title" 
          placeholder="title" 
          autocomplete="off" 
          required
          readonly="readonly"
          style="color: #000;"
        >
      </div>

      {{-- <div class="col-md-6">
        <label for="name">Status</label>
        <input 
          type="text" 
          value="{{$data['case']->case_status}}" 
          class="form-control" 
          name="case_status" 
          id="case_status" 
          placeholder="Case Status" 
          autocomplete="off" 
          required
          readonly
          style="color: #000;"
        >
      </div> --}}
      <div class="col-md-6">
        <label for="executors">Ajukan Executor</label>   

        @if (!$data['case']->executor_id)
          <select class="form-control" name="executor" required >            
        @else
          <select class="form-control" name="executor" required disabled style="color: #000;">
        @endif
          @if (count($data['executors']) === 0)
              <option value="">Tidak ada executor yang aktif</option>
          @else
            @foreach ($data['executors'] as $executor)
              @if ($executor->id == $data['case']->executor_id)
                <option value="{{$executor->id}}" selected>{{$executor->first_name.' '.$executor->last_name}}</option>
              @else
                <option value="{{$executor->id}}">{{$executor->first_name.' '.$executor->last_name}}</option>
              @endif
            @endforeach
          @endif
        </select>  
      </div>
  </div>

  <div class="row">
    <div class="col-md-6">
      <label for="description">Deskripsi</label>
      <textarea
        class="form-control" 
        style="color: #000;"
        readonly
        rows="6" 
      >{{$data['case']->description}}</textarea>
    </div>
    
    <div class="row">
      
    </div>
  </div>

  {{-- <div class="row">

    <div class="col-md-6">
      <label for="name">Email</label>
      <input type="email" value="{{$data['user']->email}}" class="form-control" name="email" id="email" placeholder="Nama Belakang" autocomplete="off" required>
    </div>
    <div class="col-md-6">
      <label for="name">NIK</label>
      <input type="text"value="{{$data['user']->NIK}}" class="form-control" name="NIK" id="NIK" placeholder="Nama Depan" autocomplete="off" required>
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      <label for="name">Hak Akses</label>
      <select class="form-control" name="access_types" id="access_types">
        @foreach ($data['access_types'] as $item)
          @if ($data['user']->access_type_id === $item->id)
            <option value="{{$item->id}}" selected>{{$item->name}}</option>
          @else
            <option value="{{$item->id}}">{{$item->name}}</option>
          @endif
        @endforeach
      </select>
    </div>
    <div class="col-md-6">
      <label for="name">Divisi</label>
      <select class="form-control" name="divisions" id="divisions">
        @foreach ($data['divisions'] as $item)
          @if ($data['user']->division_id === $item->id)
              <option value="{{$item->id}}" selected>{{$item->name}}</option>
            @else
              <option value="{{$item->id}}">{{$item->name}}</option>
            @endif
        @endforeach
      </select>
    </div>
  </div> --}}

  @if (!$data['case']->executor_id)
    <div class="row">
        <br/>
        <div class="col-md-6">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </div>
  @endif
</form>
<br />
<h4><strong>Riwayat Pengaduan:</strong></h4>
<div class="row">
  <table class="table" id="tableCat">
    <thead>
      <th width="10%">No.</th>
      <th>Tanggal</th>
      <th>Status</th>
      <th>Deskripsi</th>
    </thead>
    <tbody>
      @if (count($data['feedbacks']) > 0)
        @foreach ($data['feedbacks'] as $feedbacks)
          <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{date('d M Y - H:i', strtotime($feedbacks->created_at))}}</td>
            <td>{{$feedbacks->case_status}}</td>
            <td>{{$feedbacks->description}}</td>
          </tr>
        @endforeach
      @else
      <tr>
        <td colspan="5" align="center"> Tidak ada data</td>
      </tr>
      @endif
    </tbody>
  </table>
</div>
@endsection