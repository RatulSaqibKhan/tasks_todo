@extends('mainframe')
@section('page-title', 'User List')
@section('page-content')
<x-breadcrumb title="User List" pageName="Users" buttonLink="" buttonName="Create New" />

<div class="card">
  <div class="card-body">
    <div class="card-title">
      <h5 class="mb-0">User List</h5>
    </div>
    <hr />
    <div class="table-responsive">
      <table class="table">
        <thead>
          <tr>
            <th>SL</th>
            <th>User Name</th>
            <th>User Email</th>
            <th>Designation</th>
            <th>Phone No</th>
          </tr>
        </thead>
        <tbody>
          @forelse ($users as $user)
          <tr class="selectable-tr" data-edit-url="{{ url('/users/'.$user->id.'/edit') }}" data-delete-url="{{ url('/users/'.$user->id) }}" data-bs-toggle="tooltip" data-bs-placement="top" title="Select Item">
            <td>{{ $loop->iteration }}</td>
            <td>{{ $user->name }}</td>
            <td>{{ $user->email }}</td>
            <td>{{ $user->designation }}</td>
            <td>{{ $user->phone_no }}</td>
          </tr>
          @empty
          <tr>
            <th colspan="5">No Data Found</th>
          </tr>
          @endforelse
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection