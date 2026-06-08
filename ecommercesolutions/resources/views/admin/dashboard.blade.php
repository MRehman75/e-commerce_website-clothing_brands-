@extends('layouts.admin')
@section('content')

            <h2 class="mb-4">Welcome Admin 👋</h2>

            <!-- CARDS -->
            <div class="row g-3">

                <div class="col-md-3">
                    <div class="card-box bg1">
                        <h5>Total Users</h5>
                        <h2>120</h2>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-box bg2">
                        <h5>Products</h5>
                        <h2>80</h2>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-box bg3">
                        <h5>Orders</h5>
                        <h2>45</h2>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="card-box bg4">
                        <h5>Revenue</h5>
                        <h2>$5K</h2>
                    </div>
                </div>

            </div>

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