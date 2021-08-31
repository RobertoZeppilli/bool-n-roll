@extends('layouts.app')

@section('content')
<div class="container">
    SHOW PROFILO
    
    <h1>Nome d'arte:</h1>
    <p>{{$musician->stagename}}</p>
    
</div>
@endsection