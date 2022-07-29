@extends('layouts.dashboard')

@section('content')
<div class="row">
    {{-- name update --}}
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Change Name</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/name/update')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" value="{{Auth::user()->name}}">
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- Password update --}}
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Change Password</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/pass/update')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="" class="form-label">Old Password</label>
                        <input type="text" class="form-control" name="old_password">
                       {{-- required  --}}
                       @if(session('wrong_pass'))
                            <strong class="text-danger pt-2">{{session('wrong_pass')}}</strong>
                       @endif
                        @error('old_password')
                        <strong class="text-danger pt-2">{{$message}}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="" class="form-label">New Password</label>
                        <input type="text" class="form-control" name="new_password">
                        @if(session('same_pass'))
                             <strong class="text-danger pt-2">{{session('same_pass')}}</strong>
                        @endif
                        @error('new_password')
                            <strong class="text-danger pt-2">{{$message}}</strong>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="" class="form-label">Confirm Password</label>
                        <input type="text" class="form-control" name="confirm_password">
                        {{-- @error('confirm_password')
                            <strong class="text-danger pt-2">{{$message}}</strong>
                        @enderror --}}
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    {{-- profile pic change --}}
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Change Photo</h3>
            </div>
            <div class="card-body">
                <form action="{{url('/photo/update')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="" class="form-label">Photo</label>
                        <input type="file" class="form-control" name="profile_photo">
                        @error('profile_photo')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-info">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


</div>
@endsection
