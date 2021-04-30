@extends('layout')


@section('content')
    
   <h1>Welcome to this laravel test</h1>
   <p>In this app, order emails are dispatched to a redis queue. Afterwards, the are sent out from the queue using laravel atsk schduler</p>
   <a href="/mail">Click to send dispatch emails</a>
@endsection

