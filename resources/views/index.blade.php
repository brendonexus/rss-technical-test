@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="holder my-5 py-5">
            <div class="row">
                <div class="col-lg-8 offset-lg-2">
                    @include('partials.feed')
                </div>
            </div>
        </div>
    </div>
@endsection
