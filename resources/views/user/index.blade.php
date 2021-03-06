@extends('layouts.admin')

@section('content')
{{-- <h2>ini dari user index</h2> --}}
<h2><strong>Data Anggota:</strong></h2>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<div class="col-md-6">
  <a class="btn btn-primary" href="/users/create">Add</a>
</div>
<div class="col-md-3">

  <select class="form-control" name="filter" id="filter">
    <option value="0">All</option>
    @foreach ($data['access_types'] as $access_type)
      @if ($data['filter'] == $access_type->id)
        <option value="{{$access_type->id}}" selected>{{$access_type->name}}</option>
      @else
        <option value="{{$access_type->id}}">{{$access_type->name}}</option>
      @endif
    @endforeach
  </select>
</div>
<div class="col-md-3">
  <a class="btn btn-primary" onclick="window.location.replace(`/users?filter=`+document.getElementById('filter').value)">Filter</a>
</div>
<table class="table" id="tableCat">
  <thead>
    <th width="10%">No.</th>
    <th>Nama</th>
    <th>NIK</th>
    <th>email</th>
    <th>Status</th>
    <th>Hak akses</th>
    <th>Posisi</th>
    <th>Divisi</th>
    <th>Action</th>
  </thead>
  <tbody>
    @if (count($data['users']) > 0)
      @foreach ($data['users'] as $user)
        <tr>
          <td>{{$loop->index+1}}</td>
          <td>{{$user->first_name.' '.$user->last_name}}</td>
          <td>{{$user->NIK}}</td>
          <td>{{$user->email}}</td>
          <td>
            @if ($user->active == 1)
              {{'Active'}}
            @elseif($user->active == 2)
              {{'Expired'}}
            @else
              {{'Non Active'}}
            @endif
          </td>
          <td>{{$user->access_type}}</td>
          <td>
            @if ($user->position === null)
                -
            @else
              {{$user->position}}
            @endif
          </td>
          <td>{{$user->division}}</td>
          <td><a href="/users/{{$user->id}}">Edit</a>
            @if (Auth::user()->id !== $user->id)
            |
            {{-- delete user button --}}
            <a href="#" onclick="event.preventDefault(); confirmDelete('{{$user->id}}');">Delete</a>
            <form action="/users/{{$user->id}}" method="POST" id="delete-form-{{ $user->id }}" style="display: none;">
              @csrf
              @method('DELETE')
              <input type="hidden" value="{{ $user->id }}" name="id">
           </form>
           @endif
           {{-- delete user button --}}
          </td>
        </tr>
      @endforeach
    @else
    <tr>
      <td colspan="9" align="center"> Tidak ada data</td>
    </tr>
    @endif
  </tbody>
</table>
<span>{{$data['users']->links()}}</span>
<script>
  function confirmDelete(id) {
    const confirmAnswer = confirm('Apakah anda yakin menghapus user ini?');
    // console.log(confirmAnswer);
    // console.log(`delete-form-${id}`);
    if (confirmAnswer) {
      document.getElementById(`delete-form-${id}`).submit();
    } 
  }
</script>
@endsection