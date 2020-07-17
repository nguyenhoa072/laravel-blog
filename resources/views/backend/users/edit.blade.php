@extends('layouts.master')

@section('admin_content')
<div class="row justify-content-center">
    <div class="col-xl-6 col-lg-8 col-md-10">
        <div class="card">
            <h5 class="card-header">Edit user {{$user->name}}</h5>
            <div class="card-body">
                <form action="{{route('users.update', $user)}}" method="post">
                    @csrf
                    {{method_field('put')}}
                    <div class="form-group row">
                        <label for="name" class="col-sm-2 col-form-label">Name</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control @error('name') is-invalid @enderror" name="name"
                                value="{{ old('name', $user->name) }}">
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                                value="{{ old('email', $user->email) }}" required readonly>
                            @error('email')
                            <div class="invalid-feedback" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="roles" class="col-sm-2">Roles</label>
                        <div class="col-sm-10">
                            @foreach ($roles as $role)
                            <div class="custom-control custom-checkbox custom-control-inline">
                                <input type="checkbox" class="custom-control-input" id="{{$role->name}}" name="roles[]"
                                    value="{{$role->id}}" @if($user->roles->pluck('id')->contains($role->id)) checked
                                @endif)>
                                <label class="custom-control-label" for="{{$role->name}}">{{$role->name}}</label>
                            </div>
                            @endforeach
                            @error('roles')
                            <div class="invalid-feedback d-block" role="alert">
                                {{ $message }}
                            </div>
                            @enderror
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-auto">
                        <a href="{{route('users.index')}}" class="btn btn-secondary px-4">Close</a>
                        </div>
                        <div class="col-auto ml-auto">
                            <button type="submit" class="btn btn-primary px-4">Update</button>                        
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection