@extends('layouts.dashboard')
@section('content')
<div class="">
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3>Category List</h3>
                </div>
                <div class="card-body">
                    <form action="{{url('/mark/delete')}}" method="post">
                        @csrf
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th><input type="checkbox"  id="checkAll">Mark All</th>
                                <th>SL</th>
                                <th>Added By</th>
                                <th>Category Name</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $key=>$category )

                            <tr>
                                <td><input type="checkbox" name="mark[]" value="{{$category->id}}"></td>
                                <td>{{$key+1}}</td>
                                 <td>
                                    @php
                                    if(App\Models\User::where('id', $category->user_id)->exists()){
                                       echo $category->rel_to_user->name;
                                    }
                                    else{
                                       echo 'N/A';
                                    }
                                     @endphp
                                </td>
                                <td>{{$category->category_name}}</td>
                                <td>{{$category->created_at}}</td>
                                <td>
                                    <button name="{{ route('category.delete', $category->id) }}" type="submit" class="delete btn btn-danger mr-1"> <i class="fa fa-trash"></i> </button>
                                    <a href="{{ route('category.edit', $category->id) }}"  class="edit btn btn-success "> <i class="fa fa-pencil"></i> </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <button type="submit" class="btn btn-danger"> Marked Delete</button>
                </form>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header">
                    <h3>Trash</h3>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>SL</th>
                                <th>Added By</th>
                                <th>Category Name</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trash_cat as $key=>$trash )

                            <tr>
                                <td>{{$key+1}}</td>
                                 <td>
                                    @php
                                    if(App\Models\User::where('id', $trash->user_id)->exists()){
                                       echo $trash->rel_to_user->name;
                                    }
                                    else{
                                       echo 'N/A';
                                    }
                                    @endphp
                                 </td>
                                <td>{{$trash->category_name}}</td>
                                <td>{{$trash->created_at}}</td>
                                <td>
                                    <button name="{{ route('category.hard_delete', $trash->id) }}" type="submit" class="delete btn btn-danger "> Delete </button>
                                    <a href="{{ route('category.restore', $trash->id) }}"  class="btn btn-warning "> restore </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add Category</h3>
                </div>
                {{-- @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}
            </div>
            @endif --}}
            <div class="card-body">
                <form action="{{url('/category/insert')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="" class="form-label">Category Name</label>
                        <input type="text" class="form-control" name="category_name">
                        @error('category_name')
                        <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary">ADD</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection

{{-- from layout.app to write script & sweet alert --}}
@section('footer_script')
@if(session('success'))
<script>
    const Toast = Swal.mixin({
        toast: true
        , position: 'top-end'
        , showConfirmButton: false
        , timer: 3000
        , timerProgressBar: true
        , didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

    Toast.fire({
        icon: 'success'
        , title: '{{session('
        success ')}}'
    })

</script>
@endif

<script>
    $('.delete').click(function() {

        var link =  $(this).attr('name');
        Swal.fire({
            title: 'Are you sure?'
            , text: "You won't be able to revert this!"
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#3085d6'
            , cancelButtonColor: '#d33'
            , confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
              window.location.href = link;
            }
        })
    })

</script>

@if(session('delete'))
    <script>
        Swal.fire(
      'Deleted!',
      '{{(session('delete'))}}',
      'success'
    )
    </script>
@endif

{{-- checkbox --}}
<script>
    $("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});
</script>
@endsection
