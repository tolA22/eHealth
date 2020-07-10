
@section('schedule_create')
<div class="container">
    <div class="row justify-content-center py-5">
        
        <form method="POST" onsubmit="return false;" action="" class="form-inline">
                        @csrf

                        <!-- <option value = "Patient" {{ old('role')=='Patient' ? 'selected' : ''  }}>Patient</option>
                        <option value = "Doctor" {{ old('role')=='Doctor' ? 'selected' : ''  }}>Doctor</option>  -->

                        <div class="form-group row">
                            <!-- <label for="dob">{{ __('Role') }}</label> -->

                            <div class="col">
                                <select id="crole" placeholder="Select Doctor" class="form-control" name="role">
                                    @foreach($doctors as $doctor)
                                        <option value={{$doctor->id}} {{ old('role')== $doctor->id ? 'selected' : ''  }}>{{ucwords($doctor->name)}}</option>
                                    @endforeach
                                </select>
                                @error('role')
                           )         <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        


                        <div class="form-group row">
                            <!-- <label for="address">{{ __('Address') }}</label> -->

                            <div class="col">
                                <input id="creason" placeholder="Reason" type="text" class="form-control @error('reason') is-invalid @enderror" name="reason" value="{{ old('reason') }}" required autocomplete="reason">

                                @error('reason')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <!-- <label for="dob">{{ __('Date Of Birth') }}</label> -->

                            <div class="col ">
                                <input id="cdate" type="date" class="form-control @error('date') is-invalid @enderror" name="date" value="{{ old('date') }}" required autocomplete="date">

                                @error('date')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

<!--                         
                        <div class="form-group row text-right">

                            <div class="col">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" placeholder="Name" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div> -->
                        
                        

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button id="createSchedule" type="submit" class="btn btn-success">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
</div>
@endsection

