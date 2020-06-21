@extends('layouts.master')

@section('admin_content')

<div class="card">
    <h5 class="card-header">Edit user</h5>
    <div class="card-body">
        <form action="{{route('users.update', $user)}}" method="post">
            @csrf
            {{method_field('put')}}
            <div class="form-group">
                @foreach ($roles as $role)
                <div class="custom-control custom-checkbox">
                <input type="checkbox" class="custom-control-input" id="{{$role->name}}" name="roles[]" value="{{$role->id}}"
                @if($user->roles->pluck('id')->contains($role->id)) checked @endif)>
                    <label class="custom-control-label" for="{{$role->name}}">{{$role->name}}</label>
                </div>                
                @endforeach
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>
    </div>
</div>

@endsection
