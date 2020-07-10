@section('doctor_modal')

<div>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
  Launch demo modal
</button> -->

<!-- Modal -->
<div class="modal fade" id="doctorModal" tabindex="-1" role="dialog" aria-labelledby="doctorModal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Doctor Actions</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form method="PUT" action="" onsubmit="return false;">
                        @csrf
                        <input type="hidden" id="aid"/>
                        <input type="hidden" id="did"/>
                        <div class="deleteContent row">
                            <p>Are you sure you want to <span id="daction"></span> your schedule with <span id="dpatient"></span> on <span id="ddate"></span> ?</p>

                            
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