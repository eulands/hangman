@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Statistics</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <h1>Win: {{ $win }}</h1>
					<h1>Lost: {{ $lost }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection