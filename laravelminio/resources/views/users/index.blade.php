@extends('layouts.app')

@section('content')

        <div class="row">
            <div class="col-md-12">
                <h2>
                    <a href=""> User</a> </h2>
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $user)
                        <tr>
                            <th scope="row">{{ $user->id }}</th>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->type }}</td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                <p></p>
            </div>
        </div>
        <hr>
    

  
@endsection