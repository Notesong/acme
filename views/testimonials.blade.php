@extends('base')

@section('browsertitle')
    Testimonials
@stop

@section('content')
    <h1>Testimonials</h1>
    <br>

    <div class="list-group">
        @foreach ($testimonials as $item)
            <h4 class="list-group-item active">{!! $item->title !!} &nbsp;&nbsp; | &nbsp;&nbsp; {!! date("F d, Y", strtotime($item->created_at)) !!}</h4>
            <br>
            <p class="list-group-item-heading">{!! $item->testimonial !!}</p>
            <br><br>
        @endforeach
    </div>
@stop
