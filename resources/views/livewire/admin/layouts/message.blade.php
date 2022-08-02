@if(session('sucsess'))
  <div class="alert alert-success alert-dismissible" role="alert">
<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
       <i class="fa fa-check-circle"></i>   {{session('sucsess')}}
    </div>

@endif


 @if(session('warning'))

 <div class="alert alert-danger alert-dismissible" role="alert">
  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <i class="fa fa-times-circle"></i>
     {{session('warning')}}
 </div>
 @endif
