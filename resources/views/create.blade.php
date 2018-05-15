@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Create new game</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
					
					Create new game. Select category of questions first.
                </div>
					
					<form action="/create" method="POST" class="form-horizontal">
						{{ csrf_field() }}
						<div class="form-group">
							<label for="category_id" class="col-sm-3 control-label">Select category</label>

					<div class="row">
					<div class="col-sm-6 ml-3">
						<select name="category_id" id="category_id" class="form-control">
							@if (count($categories) > 0)
								@foreach ($categories as $category)
									<option value="{{ $category->id }}">{{ $category->category }}</option>
								@endforeach
							@endif
						</select>
					</div>
					<div class="col-sm-2">
							<button type="submit" class="btn btn-default">
								<i class="fa fa-plus"></i>Start game
							</button>
					</div>
					</div>

            </div>
					</form>
				
            </div>
        </div>
    </div>
</div>
@endsection
