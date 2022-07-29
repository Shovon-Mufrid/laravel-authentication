@extends("layouts.dashboard")
@section('content')
        <div class="row">
            <div class="col-lg-12 m-auto" >
                <div class="card">
                    <div class="card-header">
                        <h3>User List <span class="float-end">Total users: {{ $total_users }}</span></h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                           <thead>
                                <tr>
                                    <th>SL</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Created At</th>
                                    <th>Action</th>

                                </tr>
                            <tbody>
                                @foreach ($all_users as $key => $users )
                                 <tr>
                                    <td>{{ $all_users->firstitem()+$key }} </td>
                                    <td>{{ $users->name }}</td>
                                    <td>{{ $users->email }}</td>
                                    <td>{{ $users->created_at->diffForHumans()}}</td>
                                    <td>
                                        <a href="{{route('user.delete',$users->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a>
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                            </thead>
                        </table>
                        {{ $all_users->links() }}
                    </div>
                </div>
            </div>
        </div>
@endsection
