@extends('activities.layout')
 
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Polar Admin Panel</h2>
                <h3> Activities </h3>
            </div>
            <div class="pull-right">
                <a class="btn btn-success" href="{{ route('activities.create') }}"> Create New Activity</a>
            </div>
        </div>
    </div>
   
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif
   
    <table class="table table-bordered">
        <tr>
            <th>No</th>
            <th>Name</th>
            <th>Description</th>
            <th width="280px">Action</th>
        </tr>
        @foreach ($activities as $activity)
        <tr>
            <td>{{ ++$i }}</td>
            <td>{{ $activity->name }}</td>
            <td>{{ $activity->description }}</td>
            <td>
                <form action="{{ route('activities.destroy',$activity->id) }}" method="POST">
   
                    <!-- <a class="btn btn-info" href="{{ route('activities.show',$activity->id) }}">Show</a> -->
    
                    <a class="btn btn-primary" href="{{ route('activities.edit',$activity->id) }}">Edit</a>
   
                    @csrf
                    @method('DELETE')
      
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </table>
  
    {!! $activities->links() !!}
      
@endsection