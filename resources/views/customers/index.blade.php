@extends('layouts.app')

@section('content')
<h1>User Orders</h1>



<table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Createad at</th>
                <th>Details</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
            <tr>
                <td>{{$order->id}}</td>
                <td>{{$order->created_at}}</td>
                <td><a href="/customers/order/{{$order->id}}" class="btn btn-success">Show</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
    
    {{ $orders->links() }}
 

@endsection