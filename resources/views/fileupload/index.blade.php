@extends('layouts.app')

@section('content')
    <h2>Shows Object</h2>
    <div class="table-responsive">
        <table class="table table-hover">
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
    </div>

@endsection
