@section('schedule_modal')

<div>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="scheduleModal" tabindex="-1" role="dialog" aria-labelledby="scheduleModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Doctor Login</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="PUT" action="" onsubmit="return false;">
                        @csrf
                        <input type="hidden" id="fid"/>
                        <input type="hidden" id="did"/>
                        <div class="deleteContent row">
                            <p>Are you sure you want to delete your schedule with <span id="ddoctor"></span> on <span id="ddate"></span> ?</p>

                            
                        </div>

                        <div class="form-group row">
                            <label for="doctor" class="col-md-4 col-form-label text-md-right">{{ __('Doctor') }}</label>

                            <div class="col-md-6">
                                <input id="doctor" readonly type="text" class="form-control @error('doctor') is-invalid @enderror" name="doctor" value="{{ old('doctor') }}"   autocomplete="doctor" autofocus>

                                @error('doctor')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date" class="col-md-4 col-form-label text-md-right">{{ __('Date') }}</label>

                            <div class="col-md-6">
                                <input id="date" type="date" class="form-control @error('date') is-invalid @enderror" name="date"   autocomplete="date">

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="reason" class="col-md-4 col-form-label text-md-right">{{ __('Reason') }}</label>

                            <div class="col-md-6">
                                <input id="reason" type="textarea" rows="3" cols="50" class="form-control @error('reason') is-invalid @enderror" name="reason"   autocomplete="reason">

                                @error('reason')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0 show">
                            <div class="col-md-8 offset-md-4">
                                <button id="footer_action_button"  class="actionBtn btn btn-success">
                                    {{ __('Login') }}
                                </button>

                                <button id="delete_action_button"  class="actionBtn btn btn-success">
                                    {{ __('Login') }}
                                </button>

                                
                            </div>
                        </div>
                    </form>
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div> -->
    </div>
  </div>
</div>
</div>

@endSection