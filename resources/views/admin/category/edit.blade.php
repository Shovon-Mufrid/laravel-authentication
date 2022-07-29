@extends('layouts.dashboard')
@section('content')
<div class="">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h3>Edit Category</h3>
                </div>
                <div class="card-body">
                    <div class="card-body">
                        <form action="{{url('/category/update')}}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="" class="form-label">Edit Category</label>
                                <input type="hidden" class="form-control" name="id"
                                value="{{$category_info->id}}">
                                <input type="text" class="form-control" name="category_name"
                                value="{{$category_info->category_name}}">
                                @error('category_name')
                                <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
