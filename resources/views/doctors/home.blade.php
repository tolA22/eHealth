@extends('layouts.app')
@extends('components.doctor_modal')
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
        <div class="col">
            <!-- Chart's container -->

            <div id="chart" style="height: 300px;"></div>
        
        </div>
    </div>
    <div class="row py-4">
        <div class="col-12 table-responsive">
        <table class="table table-bordered" id="table">
               <thead>
                  <tr>
                     <th class='d-none'>Id</th>
                     <th>Patient</th>
                     <th>Date</th>
                     <th>Reason</th>
                     <th>Status</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody id="doctorTable">
                   
                   @foreach($data as $item)
                    <tr class="item{{$item->id}}">
                        <td class='d-none'>{{$item->id}}</td>    
                        <td>{{ucwords($item->patient->name)}}</td>  
                        <td>{{ucwords($item->date_of_visit)}}</td>    
                        <td>{{ucwords($item->reason)}}</td>   
                        <td>{{ucwords($item->status)}}</td>   
                        <td><button class="approve-modal btn btn-success" data-info="{{$item->id}},{{ucwords($item->patient->name)}},{{ucwords($item->date_of_visit)}},{{ucwords($item->reason)}}">
                                <span class="glyphicon glyphicon-edit"></span> Approve</button>
                            <button class="decline-modal btn btn-danger" data-info="{{$item->id}},{{ucwords($item->patient->name)}},{{ucwords($item->date_of_visit)}},{{ucwords($item->reason)}}">
                                <span class="glyphicon glyphicon-trash"></span>Decline</button></td> 
                    </tr>
                   @endforeach
                </tbody>
            </table>
        </div>

    </div>
</div>

<script>
    $(document).on('click', '.approve-modal', function() {
        // console.log("mdoal");
        $('#footer_action_button').text("Approve");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').removeClass('delete');
        $('.actionBtn').addClass('edit');
        $('.modal-title').text('Approve Schedule');
        
        $('#delete_action_button').hide();
        $('#footer_action_button').show();
        $('.form-horizontal').show();
        var stuff = $(this).data('info').split(',');
        $('#aid').val(stuff[0]);
        $('#daction').text('approve');
        $('#dpatient').text(stuff[1]);
        $('#ddate').text(stuff[2]);
        $('.deleteContent').show();
        // updateModal();
        $('#doctorModal').modal('show');
    });



    $('#footer_action_button').on('click', function() {
        console.log('here');
        let url = '/schedule/approve/'+$("#aid").val();
        var stuff = $('.approve-modal').data('info').split(',');

        $.ajax({
            type: 'put',
            headers: {
                'Accept':'application/json'
            },
            // datatype:'json',
            url: url,
            data: {
                _token: $('input[name=_token]').val(),
                id:stuff[0],
                patient: stuff[1],
                date:stuff[2],
                reason:stuff[3],
                status:'Approved'
            },
            success: function(dat){
                
                dat = dat.message;
                // console.log(data);
                  $('.item' + dat.id).replaceWith("<tr class='item" + dat.id + "'><td class='d-none'>" +
                        dat.id + "</td><td>" + dat.patient +
                        "</td><td>" + dat.date + "</td><td>" + dat.reason + "</td><td>" +
                         dat.status +
                          "</td><td><button class='approve-modal btn btn-success' data-info='" + dat.id+","+dat.patient+","+dat.date+","+dat.reason+","+"'><span class='glyphicon glyphicon-edit'></span>  Approve</button> <button class='decline-modal btn btn-danger' data-info='" + dat.id+","+dat.name+","+dat.date+","+dat.reason+","+dat.status+","+","+"' ><span class='glyphicon glyphicon-trash'></span> Decline</button></td></tr>");
                        //   $('#table').DataTable().ajax.reload(null,false);
  
           
        $('#doctorModal').modal('hide');
            
                        }
        });
    });


    $(document).on('click', '.decline-modal', function() {
        $('#delete_action_button').text(" Decline");
        $('#delete_action_button').removeClass('glyphicon-check');
        $('#delete_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').removeClass('edit');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Decline Schedule');
        
        $('#delete_action_button').show();
        $('#footer_action_button').hide();
        $('.form-group').hide();
        $('.show').show();
        var stuff = $(this).data('info').split(',');
        $('#did').val(stuff[0]);
        $('#daction').text('decline');
        $('#dpatient').text(stuff[1]);
        $('#ddate').text(stuff[2]);
        $('.deleteContent').show();

        $('#doctorModal').modal('show');
        })
    
    ;


    $('#delete_action_button').on('click', function() {
        console.log("decloient");
        let url = '/schedule/decline/'+$("#did").val();

        $.ajax({
            type: 'put',
            headers: {
                'Accept':'application/json'
            },
            url: url,
            data: {
                '_token': $('input[name=_token]').val(),
                
            },
            success: function(data) {
                data = data.message;
                console.log(data);
                  $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td class='d-none'>" +
                        data.id + "</td><td>" + data.patient +
                        "</td><td>" + data.date + "</td><td>" + data.reason + "</td><td>" +
                         data.status +
                          "</td><td><button class='approve-modal btn btn-success' data-info='" + data.id+","+data.patient+","+data.date+","+data.reason+","+"'><span class='glyphicon glyphicon-edit'></span>  Approve</button> <button class='decline-modal btn btn-danger' data-info='" + data.id+","+data.name+","+data.date+","+data.reason+","+data.status+","+","+"' ><span class='glyphicon glyphicon-trash'></span> Decline</button></td></tr>");
                        //   $('#table').DataTable().ajax.reload();
        $('#doctorModal').modal('hide');

            }
        });
    });


   


</script>

<!-- Charting library -->
<script src="https://unpkg.com/echarts/dist/echarts.min.js"></script>
    <!-- Chartisan -->
    <script src="https://unpkg.com/@chartisan/echarts/dist/chartisan_echarts.js"></script>
    <!-- Your application script -->
    <script>
      const chart = new Chartisan({
        el: '#chart',
        url: "@chart('sample_chart')?id="+{{Auth::id()}},
        options:{
            
        }
      });
    </script>


@endsection
