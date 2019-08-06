@extends('layouts.admin')

@section('content')
<h2><strong>Form Event:</strong></h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
  <form method="POST" action="/events/{{$event->id}}" enctype="multipart/form-data">
  @csrf
  @method('PUT')
  <div class="row">
    <div class="col-md-6">
      <label for="title">Judul Event</label>
      <input type="text" value="{{$event->title}}" class="form-control" name="title" id="title" placeholder="Judul" autocomplete="off" required>
    </div>

    <div class="col-md-6">
        <label for="picture">Upload Gambar</label>
        <input type="file" class="form-control" name="picture" id="picture" onchange="readURL(this);">
      </div>
    </div>
    
    <div class="row">
      <div class="col-md-6">
        <label for="title">Deskripsi</label>
        <textarea class="form-control" name="description" id="description" rows="5" placeholder="Deskripsi">{{$event->description}}</textarea>
      </div>
      <div class="col-md-6">
        <label for="preview">Preview</label><br />
        <img id="preview" width="200" src="{{$event->picture}}" class="img-fluid" alt="your image" />
      </div>
    </div>

  <div class="row">
      <br/>
      <div class="col-md-6">
          <button type="submit" class="btn btn-primary">Submit</button>
      </div>
  </div>
</form>

<script type="text/javascript">
  function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#preview').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }
</script>
@endsection