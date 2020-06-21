@extends('layouts.master')

@section('admin_content')

<div class="card">
    <h5 class="card-header">Users</h5>
    <div class="card-body">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">#</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Role</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                <tr>
                <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{ implode(', ', $user->roles()->get()->pluck('name')->toArray()) }}</td>
                    <td>              
                        @can('edit-user')          
                        <a href="{{route('users.edit', $user->id)}}" class="btn btn-warning">
                            <i class="fa fa-pencil" aria-hidden="true"></i>
                        </a>
                        @endcan
                        @can('delete-user')         
                        <form action="{{route('users.destroy', $user)}}" method="post" class="float-left mr-2">
                            @csrf
                            {{method_field('delete')}}
                            <button type="submit" class="btn btn-danger">
                                <i class="fa fa-trash" aria-hidden="true"></i>
                            </button>
                        </form>
                        @endcan                        
                    </td>
                </tr>
                @endforeach
              
            </tbody>
          </table>
    </div>
</div>

@endsection
