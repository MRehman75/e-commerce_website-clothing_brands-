@extends('layouts.admin')
@section('content')
<h1>Orders Page</h1>
<!-- TABLE -->
            <div class="card mt-4 p-3">
                <h5>Recent Activity</h5>
                <table class="table table-striped mt-2">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                            <th>Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Ali</td>
                            <td>Login</td>
                            <td>Today</td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Ahmed</td>
                            <td>Added Product</td>
                            <td>Yesterday</td>
                        </tr>
                    </tbody>
                </table>
            </div>
@endsection


