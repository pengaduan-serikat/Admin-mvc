@extends('layouts.admin')

@section('content')
<h2><strong>Form:</strong></h2>
<form method="POST" action="/divisions/">
  @csrf
  <div class="row">
      <div class="col-md-6">
        <label for="name">Nama Divisi</label>
        <input type="text" class="form-control" name="name" id="name" placeholder="Nama Divisi" autocomplete="off" required>
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