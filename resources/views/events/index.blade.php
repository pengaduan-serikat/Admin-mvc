@extends('layouts.admin')

@section('content')
<h2><strong>Upload Event:</strong></h2>
<div class="col-md-12">
  <a class="btn btn-primary" href="/events/create">Add</a>
</div>
<table class="table" id="tableCat">
    <thead>
      <th width="10%">No.</th>
      <th>Judul</th>
      <th>Tanggal</th>
      <th>Action</th>
    </thead>
    <tbody>
      @if (count($events) > 0)
        @foreach ($events as $event)
          <tr>
            <td>{{$loop->index+1}}</td>
            <td>{{$event->title}}</td>
            <td>{{date('d M Y', strtotime($event->created_at))}}</td>
  
            <td><a href="/events/{{$event->id}}">Edit</a>  | <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $event->id }}').submit();">Delete</a>
              <form action="/events/{{$event->id}}" method="POST" id="delete-form-{{ $event->id }}" style="display: none;">
                @csrf
                @method('DELETE')
                <input type="hidden" value="{{ $event->id }}" name="id">
             </form>
            </td>
          </tr>
        @endforeach
      @else
      <tr>
        <td colspan="3" align="center"> Tidak ada data</td>
      </tr>
      @endif
    </tbody>
</table>
@endsection