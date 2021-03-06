@extends('layouts.app')

@section('content')
    <div class="row">
        
        <!-- Display Validation Errors -->
        @include('common.errors')
        
        <div class="twelve columns">
            <form action="/track" method="post" enctype="multipart/form-data">
            {{ csrf_field() }}
                
                <label for="title">Title:</label>
                <input type="text" name="title" id="title">
                
                <label for="artist">Artist:</label>
                <input type="text" name="artist" id="artist">
                
                <label for="max_downloads">Max Downloads:</label>
                <select name="max_downloads" id="max_downloads">
                    <option value=1>1</option>
                    <option value=100>100</option>
                    <option value=500>500</option>
                    <option value=1000>1000</option>
                    <option value=10000>10000</option>
                </select>
                
                <label for="track">Select Track for Upload: </label>
                <input type="file" name="track" id="track">
                
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="submit" value="Upload Track" name="submit">
            </form>
        </div>
    </div>
@endsection