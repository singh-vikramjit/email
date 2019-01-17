@extends('layouts.admin')

@section('content')
<div class="card">
  <div class="card-header header-elements-inline">
    <h5 class="card-title">Users List</h5>
    <div class="header-elements">
      <div class="list-icons">
          <a class="list-icons-item" data-action="collapse"></a>
          <!-- <a class="list-icons-item" data-action="reload"></a>
          <a class="list-icons-item" data-action="remove"></a> -->
      </div>
    </div>
  </div>

  <div class="card-body">
    
  </div>

  <table class="table table-striped table-bordered datatable-basic">
    <thead>
      <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Date</th>
        <th class="text-center">Actions</th>
     </tr>
    </thead>
    <tbody>
      @foreach ($users as $user)
      <tr>
        <td>{{ $user['id'] }}</td>
        <td>{{ $user['name'] }}</td>
        <td>{{ $user['email'] }}</td>
        <td>{{ $user['created_at'] }}</td>
        <td class="text-center">
          <div class="list-icons">
            <div class="dropdown">
              <a href="#" class="list-icons-item" data-toggle="dropdown">
                <i class="icon-menu9"></i>
              </a>
              <div class="dropdown-menu dropdown-menu-right">
                <a href="#" class="dropdown-item"><i class="icon-file-pdf"></i> Export to .pdf</a>
                <a href="#" class="dropdown-item"><i class="icon-file-excel"></i> Export to .csv</a>
                <a href="#" class="dropdown-item"><i class="icon-file-word"></i> Export to .doc</a>
              </div>
            </div>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>
</div>
@endsection
