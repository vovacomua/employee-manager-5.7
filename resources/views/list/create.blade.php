@extends('layouts.master')


@section('content')

  <div class="container">
    <div class="row justify-content-center">
      <div class="col-md-8">
        <div class="card mt-4">
          <div class="card-header">Create Employee</div>
          <div class="card-body">

            @if (\Session::has('error'))
              <div class="alert alert-danger mt-3">
                  <p>{{ \Session::get('error') }}</p>
              </div><br />
            @endif

              <form method="post" action="{{ action('EmployeeController@store' )}}" enctype="multipart/form-data"> 
                  {{ csrf_field() }}

                <div class="form-group row">
                  <label for="parent_id" class="col-md-4 col-form-label text-md-right">Boss</label>

                  <div class="col-md-6">
                      <input id="parent_id" type="text" pattern="^\d{1,10}$" class="form-control" name="parent_id">
                  </div>
              </div>

              <div class="form-group row">
                  <label for="full_name" class="col-md-4 col-form-label text-md-right">Full Name*</label>

                  <div class="col-md-6">
                      <input id="full_name" type="text" maxlength="255" class="form-control" name="full_name" required autofocus>
                  </div>
              </div>

              <div class="form-group row">
                  <label for="position" class="col-md-4 col-form-label text-md-right">Position*</label>

                  <div class="col-md-6">
                      <input id="position" type="text" maxlength="255" class="form-control" name="position" required>
                  </div>
              </div>

               <div class="form-group row">
                  <label for="start_date" class="col-md-4 col-form-label text-md-right">Starting Date*</label>

                  <div class="col-md-6">
                      <input id="start_date" type="date" class="form-control" name="start_date" required>
                  </div>
              </div>

              <div class="form-group row">
                  <label for="salary" class="col-md-4 col-form-label text-md-right">Salary*</label>

                  <div class="col-md-6">
                      <input id="salary" type="text" pattern="^\d{1,5}(\.\d{2})?$" class="form-control" name="salary" required>
                  </div>
              </div>

              <div class="form-group row">
                  <label class="col-md-4 col-form-label text-md-right"></label>

                  <div class="col-md-6" id="photo-preview">
                    <img src="{{ asset('storage/photos/no-photo.jpg') }}" style="max-height:150px">
                  </div>
              </div>

              <div class="form-group row">
                  <label for="photo" class="col-md-4 col-form-label text-md-right">Add Photo (.jpeg)</label>

                  <div class="col-md-6">
                      
                      <label class="btn btn-outline-secondary"> Browse 
                        <input id="photo" type="file" class="form-control" name="photo" accept="image/jpeg" hidden>
                      </label>
                  </div>
              </div>             

              <div class="form-group row mb-0">
                  <div class="col-md-8 offset-md-4">
                      <button type="submit" class="btn btn-primary">
                          SUBMIT
                      </button>
                  </div>
              </div>

               @include ('layouts.errors')

          </form>

          </div>
        </div>
      </div>
    </div>
  </div>

  @include ('list.scripts-photo')

@endsection
