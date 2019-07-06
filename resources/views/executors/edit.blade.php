@extends('layouts.admin')

@section('content')
<h2><strong>Form:</strong></h2>
<form method="POST" action="/executors/{{$data['user']->id}}">
  @csrf
  @method('PUT')
  <div class="row">
      <div class="col-md-6">
        <label for="name">Nama Depan</label>
        <input value="{{$data['user']->first_name}}" type="text" class="form-control" name="first_name" id="first_name" placeholder="Nama Depan" autocomplete="off" required>
      </div>
      <div class="col-md-6">
        <label for="name">Nama Belakang</label>
        <input type="text" value="{{$data['user']->last_name}}" class="form-control" name="last_name" id="last_name" placeholder="Nama Belakang" autocomplete="off" required>
      </div>
  </div>
  <div class="row">

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
      {{-- {{$data}} --}}
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
  </div>
  <div class="row">
    <div class="col-md-6">
      <label for="name">Posisi</label>
      <select class="form-control" name="positions" id="positions">
          @foreach ($data['positions'] as $item)
            @if ($data['user']->position_id === $item->id)
              <option value="{{$item->id}}" selected>{{$item->name}}</option>
            @else
              <option value="{{$item->id}}">{{$item->name}}</option>
            @endif
          @endforeach
        </select>
    </div>
  </div>

  <div class="row">
      <br/>
      <div class="col-md-6">
          <button type="submit" class="btn btn-primary">Submit</button>
      </div>
  </div>
</form>
@endsection