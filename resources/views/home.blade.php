@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Current game</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if (count($word) > 0)
					
					@if($word->last_turn > 0)
						<img src="{{asset('images/').'/hangman'.($word->last_turn - $word->right_turn).'.jpg'}}">
						<p>Bad turns: {{ ($word->last_turn - $word->right_turn) }}/5</p>
						<h3>{{ $word->result_text }}</h3>
					@endif
					<h1>{{ $word->shown }}</h1> 
					<h5>Description: {{ $word->description }}</h5>
					@if($word->result_text == "")
					<form action="/turn" method="POST" class="form-horizontal">
					<div class="row">
					<div class="col-sm-6">
						
						{{ csrf_field() }}
						<select name="letter" id="letter" class="form-control">
							@if (count($letters) > 0)
								@foreach ($letters as $letter)
									<option value="{{ $letter }}">{{ $letter }}</option>
								@endforeach
							@endif
						</select>
					</div>
					<div class="col-sm-2">
							<button type="submit" class="btn btn-default">
								<i class="fa fa-plus"></i>Make turn
							</button>
					</div>
					</div>
					</form>
					@endif
					@endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
