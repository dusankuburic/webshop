@extends('layouts.app')


@section('content')
<div class="row justify-content-center">
    <div class="col-lg-7">
    <h2>Edit</h2>              
    {!! Form::open(['action' => ['AdminProductsController@update',$product->id], 'method' => 'POST']) !!}
        <div class="form-group">
            {{Form::label('name','Name')}}
            {{Form::text('name',$product->name,['class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('vendor','Vendor')}}
            {{Form::text('vendor',$product->vendor,['class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('category','Category')}}
            {{Form::select('category_id',[]+$categories,null,['class' => 'form-control'])}}
        </div>
    
        <div class="form-group">
            {{Form::label('description','Description')}}
            {{Form::textarea('description',$product->description,['class' => 'form-control'])}}
        </div>

        <div class="form-group">
            {{Form::label('price','Price')}}
            {{Form::text('price',$product->price,['class' => 'form-control'])}}
        </div>

            @method('PUT')
        {{Form::submit('Save',['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
    </div>
</div>

@endsection