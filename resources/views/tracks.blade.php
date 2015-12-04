@extends('layouts.app')

@section('content')
    <div class="row">
        
        <!-- Display Validation Errors -->
        @include('common.errors')
        
        <div class="twelve columns">
            <form action="/upload">
                <input type="submit" value="Upload a Track">
            </form>
        </div>
            
        @if (count($tracks) > 0)
            @foreach ($tracks as $track)
                <div class="row">
                    <div class="three columns">
                        <h5>{{ $track->title }} - {{ $track->artist }}</h5>
                    </div>
                    <div class="six columns" id="{{ $track->title }}">
                        <audio controls preload="metadata">
                            <source src={{ $track->path_lq }} type="audio/mpeg">
                            Your browser does not support the audio tag.
                        </audio>
                    </div>
                    <div class="three columns">
                        <form action="/dubz/dowload/{{ $track->id }}">
                            <input type="submit" value="Download">
                        </form>
                    </div>
                </div>
            @endforeach
        @else
            <div class="twelve columns">
                <h3>No Dubz have been Uploaded</h3>
            </div>
        @endif
@endsection