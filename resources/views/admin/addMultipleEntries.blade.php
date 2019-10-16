@extends('layouts.default')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
			<p class="display-4">Add Multiple Books</p>
			<div class="mt-2">
				<div class="card">
					<div class="card-header">Through Google Api</div>
					<div class="card-body">
						Search for the term. Top 10 results will be added to the database.
						<form>
						  <div class="form-row align-items-center">
							<div class="col-auto">
							  <label class="sr-only" for="inlineFormInput">Name</label>
							  <input type="text" class="form-control mb-2" id="inlineFormInput" placeholder="Jane Doe">
							</div>
							<div class="col-auto">
							  <button type="submit" class="btn btn-primary mb-2">Submit</button>
							</div>
						  </div>
						</form>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>
@endsection
