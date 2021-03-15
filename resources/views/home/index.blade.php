@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                <div class="col-md-12">
                <h2>
                    <a href=""> Media</a> </h2>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">size</th>
                            </tr>
                        </thead>
                        <tbody>
                        @if (is_array($results) )
                        @foreach($results as  $id => $value  )
                        <tr>
                            <th scope="row">     {{ $id }}    </th>
                            <td>{{ $value["Key"] }}</td>
                            <td>{{ $value["Size"] }}</td>
                            <td>
                              <form action="{{ route('download_fileupload_path') }}" method="post">
                                    <input type="hidden"  id="filename" name="filename" value='{{ $value["Key"] }}'>
                                    {{ csrf_field() }}
                                    <button type="submit" class='btn btn-danger'>Download</button>
                                </form>
                            </td>
                        </tr>
                       
                            
                        @endforeach
                        @else
                            <tr> no hay datos                             </tr>
                        @endif
                        </tbody>
                    </table>
                <p></p>
            </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
