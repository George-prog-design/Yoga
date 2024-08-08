<!-- JAVASCRIPT -->
<script src="{{asset('Backend Theme/assets/libs/jquery/jquery.min.js')}}"></script>
<script src="{{asset('Backend Theme/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('Backend Theme/assets/libs/metismenu/metisMenu.min.js')}}"></script>
<script src="{{asset('Backend Theme/assets/libs/simplebar/simplebar.min.js')}}"></script>
<script src="{{asset('Backend Theme/assets/libs/node-waves/waves.min.js')}}"></script>

<script src="{{asset('Backend Theme/assets/js/app.js')}}"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
@if(Session::has('message'))
var type = "{{ Session::get('alert-type','info') }}"
switch(type){
case 'info':
toastr.info(" {{ Session::get('message') }} ");
break;

case 'success':
toastr.success(" {{ Session::get('message') }} ");
break;

case 'warning':
toastr.warning(" {{ Session::get('message') }} ");
break;

case 'error':
toastr.error(" {{ Session::get('message') }} ");
break;
}
@endif
</script>
