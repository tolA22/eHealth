@extends('layouts.app')
@extends('components.schedule_modal')
@extends('components.schedule_create')
@section('content')
<!-- <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div>
    </div>
</div> -->
<div class="container">
    <div class="row">
        <div class="col-12 table-responsive">
        <table class="table table-bordered" id="table">
               <thead>
                  <tr>
                     <th class='d-none'>Id</th>
                     <th>Doctor</th>
                     <th>Date</th>
                     <th>Reason</th>
                     <th>Status</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody id="patientTable">
                   
                   @foreach($data as $item)
                    <tr class="item{{$item->id}}">
                        <td class='d-none'>{{$item->id}}</td>    
                        <td>{{ucwords($item->doctor->name)}}</td>  
                        <td>{{ucwords($item->date_of_visit)}}</td>    
                        <td>{{ucwords($item->reason)}}</td>   
                        <td>{{ucwords($item->status)}}</td>   
                        <td><button class="edit-modal btn btn-info" data-info="{{$item->id}},{{ucwords($item->doctor->name)}},{{ucwords($item->date_of_visit)}},{{ucwords($item->reason)}}">
                                <span class="glyphicon glyphicon-edit"></span> Edit</button>
                            <button class="delete-modal btn btn-danger" data-info="{{$item->id}},{{ucwords($item->doctor->name)}},{{ucwords($item->date_of_visit)}},{{ucwords($item->reason)}}">
                                <span class="glyphicon glyphicon-trash"></span> Delete</button></td> 
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
    $(document).on('click', '.edit-modal', function() {
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Edit Schedule');
        $('.deleteContent').hide();
        $('#delete_action_button').hide();
        $('#footer_action_button').show();
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        $('#fid').val(stuff[0]);
        $('#doctor').val(stuff[1]);
        $('#date').val(stuff[2]);
        $('#reason').val(stuff[3]);
        // updateModal();
        
        $('#scheduleModal').modal('show');
    });



    $('#footer_action_button').on('click', function() {
        console.log('here');
        let url = '/schedule/update/'+$("#fid").val();
        $.ajax({
            type: 'put',
            headers: {
                'Accept':'application/json'
            },
            url: url,
            data: {
                '_token': $('input[name=_token]').val(),
                'doctor': $('#doctor').val(),
                'date_of_visit': $('#date').val(),
                'reason': $('#reason').val()
            },
            success: function(data){
                data = data.message;
                // console.log(data);
                  $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='d-none'>" +
                        data.id + "</td><td>" + data.doctor +
                        "</td><td>" + data.date + "</td><td>" + data.reason + "</td><td>" +
                         data.status +
                          "</td><td><button class='edit-modal btn btn-info' data-info='" + data.id+","+data.doctor+","+data.date+","+data.reason+","+"'><span class='glyphicon glyphicon-edit'></span> Edit</button> <button class='delete-modal btn btn-danger' data-info='" + data.id+","+data.doctor+","+data.date+","+data.reason+","+data.status+","+","+"' ><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
           
        $('#scheduleModal').modal('hide');
            
                        }
        });
    });


    $(document).on('click', '.delete-modal', function() {
        $('#delete_action_button').text(" Delete");
        $('#delete_action_button').removeClass('glyphicon-check');
        $('#delete_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete');
        $('.deleteContent').show();
        
        $('#delete_action_button').show();
        $('#footer_action_button').hide();
        $('.form-group').hide();
        $('.show').show();
        var stuff = $(this).data('info').split(',');
        $('#did').val(stuff[0]);

        $('#ddoctor').text(stuff[1]);
        $('#ddate').text(stuff[2]);
        $('#scheduleModal').modal('show');
        })
    
    ;


    $('#delete_action_button').on('click', function() {
        // console.log("here");
        $.ajax({
            type: 'delete',
            url: '/schedule/delete/'+$("#did").val(),
            data: {
                '_token': $('input[name=_token]').val(),
            
            },
            success: function(data) {
                $('.item' + $('#did').val()).remove();
                $('#scheduleModal').modal('hide');

            }
        });
    });


    $('#createSchedule').on('click', function() {
        console.log("here");
        $.ajax({
            type: 'post',
            url: '/schedule/create',
            data: {
                '_token': $('input[name=_token]').val(),
                'doctor_id':$('#crole').val(),
                'reason':$('#creason').val(),
                'date_of_visit':$('#cdate').val(),
            },
            success: function(data) {
                // console.log(data);
                data = data.message;
                $("#patientTable").prepend("<tr class='item"+data.id+"'><td class='d-none'>"+data.id+"</td><td>"+data.doctor+"</td><td>"+data.date+"</td><td>"+data.reason+"</td><td>"+data.status+"</td><td><button class='edit-modal btn btn-info' data-info='"+data.id+","+data.doctor+","+data.date+","+data.reason+"'><span class='glyphicon glyphicon-edit'></span> Edit</button>"+"<button class='delete-modal btn btn-danger ml-1' data-info='"+data.id+","+data.doctor+","+data.date+","+data.reason+"'><span class='glyphicon glyphicon-edit'></span> Delete</button>"+"</td></tr>");




               }
        });
    });


</script>
@endsection
