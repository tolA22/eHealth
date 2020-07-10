@extends('layouts.app')

@section('content')
<div class="bg-light" id="homeContainer">
    <div class="container ">
        <div class=" row  py-4 justify-content-center ">
           

                <div class="col-12 col-md-6 order-2">
                    <img id="doc" src="{{ asset('images/doc.jpg') }}" alt="">
            
                </div>
                <div class="col-12 col-md-6 order-1 m-auto">
                    <h3 class="font-weight-bold text-justify">Virtual healthcare for you</h3>
                    <div class="bg-primary underline">
                    </div>
                    <h5 class="py-3 text-secondary text-justify font-weight-lighter text-md-left">eHealth provides progressive, and affordable healthcare, accessible on web and mobile for everyone</h5>
                    
                </div>
            </div>    
            
       
        
    </div>
</div>
<div id="homeContainer2" class="bg-white">
    <div class="container">
    <div class="row  justify-content-center py-2 bg-white">
         
                <div class="col-12 col-md-6 order-2 order-md-1 text-center">
                    <img id="doc2" src="{{ asset('images/doc2.jpg') }}" alt="">
            
                </div>
                <div class="col-12 col-md-6 order-1 order-md-2 m-auto ">
                    <h3 class="font-weight-bold text-justify text-md-right">We take care of your health</h3>
                    <div class="bg-primary underlinePurple float-md-right">
                    </div>
                    <h5 class="py-3 text-secondary text-justify text-md-right">Health problems,even minor ones, can interfere with or even overshadow other aspects of your life. Even relatively minor health issues such as aches,pain, lethargy, and indigestion.</h5>
                </div>
            
</div>      
    </div>
</div>
@endsection

