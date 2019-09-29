@extends('layouts.app')

@section('content')
<h1>Buy Our products</h1>
<div class="row justify-content-center">
        
            @if(isset($products))

                @foreach ($products as $product)
                    <div class="col-sm-6 col-lg-3">                          
                        {!! Form::open(['action' => 'CartsController@storeHome', 'method'=>'POST']) !!}

                            <div class="card">
                                <div class="card-header">
                                    <input type="hidden" name="product_id" value="{{$product->id}}"></input>
                                    <input type="hidden" name="name" value="{{$product->name}}"></input>
                                    {{$product->name}}
                                </div>
                                <div class="card-body">
                                    <p class="card-title">{{$product->vendor}}</p>
                                    <input type="hidden" name="price" value="{{$product->price}}"></input>
                                    <p class="card-text">{{$product->price}}</p>
                                    {{Form::submit('Add To Cart',['class' => 'btn btn-primary'])}}
                                </div>
                            </div>
                        {!! Form::close() !!}
                            <br>
                    </div>              
                @endforeach
            @else 
                <h1>Nema nista</h1>
            @endif
    </div>
    
    
@endsection