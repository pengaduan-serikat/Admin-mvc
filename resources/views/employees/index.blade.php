@extends('layouts.admin')

@section('content')
{{-- <h2>ini dari user index</h2> --}}
<h2><strong>Data Anggota Karyawan:</strong></h2>
<div class="col-md-12">
  <a class="btn btn-primary" href="/employees/create">Add</a>
</div>
<table class="table" id="tableCat">
  <thead>
    <th width="10%">No.</th>
    <th>Nama</th>
    <th>NIK</th>
    <th>Hak akses</th>
    <th>Posisi</th>
    <th>Divisi</th>
    <th>Action</th>
  </thead>
  <tbody>
    @if (count($users) > 0)
      @foreach ($users as $user)
        <tr>
          <td>{{$loop->index+1}}</td>
          <td>{{$user->first_name.' '.$user->last_name}}</td>
          <td>{{$user->NIK}}</td>
          <td>{{$user->access_type}}</td>
          <td>{{$user->position}}</td>
          <td>{{$user->division}}</td>
          <td><a href="/employees/{{$user->id}}">Edit</a>
            @if (Auth::user()->id !== $user->id)
            |
            {{-- delete user button --}}
            <a href="#" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $user->id }}').submit();">Delete</a>
            <form action="/employees/{{$user->id}}" method="POST" id="delete-form-{{ $user->id }}" style="display: none;">
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
      <td colspan="7" align="center"> Tidak ada data</td>
    </tr>
    @endif
  </tbody>
</table>
@endsection