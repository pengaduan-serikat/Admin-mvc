@extends('layouts.admin')

@section('content')
<h2><strong>Form:</strong></h2>
<form method="POST" action="/positions/{{$position->id}}">
  @csrf
  @method('PUT')
  <div class="row">
      <div class="col-md-6">
        <label for="name">Nama Posisi</label>
        <input type="text" value="{{$position->name}}" class="form-control" name="name" id="name" placeholder="Nama Posisi" autocomplete="off" required>
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