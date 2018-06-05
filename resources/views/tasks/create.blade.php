@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-xs-6">
    

        {!! Form::model($task, ['route' => 'tasks.store']) !!}
    <div class="form-group">
        {!! Form::label('status', 'タイトル:') !!}
        {!! Form::text('status') !!}
    </div>

    <div class="form-group">
	    {!! Form::label('content', 'メッセージ:') !!}
        {!! Form::text('content') !!}
    </div>       
        
        
        {!! Form::submit('投稿', ['class' => 'btn btn-primary']) !!}

        {!! Form::close() !!}

@endsection
