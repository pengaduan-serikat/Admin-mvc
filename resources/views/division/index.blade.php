@extends('layouts.admin')

@section('content')
    {{-- <h2>ini dari division index</h2> --}}
    <h2><strong>Data Divisi:</strong></h2>
    <table class="table" id="tableCat">
        <thead>
            <th>No.</th>
            <th>Name</th>
            <th>Age</th>
            <th>price</th>
            <th>Status</th>
            <th>Type</th>
            <th>Action</th>
        </thead>
        <tbody>
                <tr>
                    <td>1</td>
                    <td>2</td>
                    <td>3</td>
                    <td>4</td>
                    <td>5</td>
                    <td>6</td>
                    <td><a href="/admin/edit-cat/<%=data[i].id%>">Edit</a>  | <a href="/admin/delete-cat/<%=data[i].id%>">Delete</a></td>
                </tr>
        </tbody>
    </table>
@endsection