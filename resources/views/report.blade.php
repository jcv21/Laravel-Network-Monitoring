@extends('layout.app')


@section('content')

<br>
  <h4>Reporting</h4>
<br>
<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <form action="{{ route('report') }}" method="post">
              @csrf
              <div class="form-group col-12 col-sm-12 col-md-3 col-lg-3">
                <select class="form-control" name="InputReportType" id="InputReportType">
                  <option value selected disabled>Report Type</option>
                  <option value="1">Bandwidth Used</option>
                  <option value="2">Network Traffic</option>
                </select>
              </div>
              <div class="form-group col-12 col-sm-12 col-md-3 col-lg-3">
                <input id="InputSDate" name="InputSDate" class="date-picker form-control" placeholder="Start Date" type="text" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
              </div>
              <div class="form-group col-12 col-sm-12 col-md-3 col-lg-3">
                <input id="InputEDate" name="InputEDate" class="date-picker form-control" placeholder="End Date" type="text" required="required" onfocus="this.type='date'" onmouseover="this.type='date'" onclick="this.type='date'" onblur="this.type='text'" onmouseout="timeFunctionLong(this)">
              </div>
              <div class="co-12 col-sm-12 col-md-3 col-lg-3">
                <button class="btn btn-primary" type="submit" id="BtnGenerateReport" name="BtnGenerateReport">Generate</button>
              </div>
            </form>
          </div>
          {{-- <div class="form-group">
            <iframe src="" frameborder="1" width="100%" height="500px"></iframe>
          </div> --}}
        </div>
      </div>
    </div>
</div>

@endsection