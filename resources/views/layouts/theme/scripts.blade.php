
 
 <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
 <script src="{{ asset('assets/js/libs/jquery-3.1.1.min.js') }}"></script>
 <script src="{{ asset('bootstrap/js/popper.min.js') }}"></script>
 <script src="{{ asset('bootstrap/js/bootstrap.min.js') }}"></script>
 <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
 <script src="{{ asset('assets/js/app.js') }}"></script>

 <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

 <script>
     $(document).ready(function() {
         App.init();
     });
 </script>
  <script src="{{ asset('plugins/highlight/highlight.pack.js') }}"></script>
 <script src="{{ asset('assets/js/custom.js') }}"></script>
 <!-- END GLOBAL MANDATORY SCRIPTS -->

 <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
 <script src="{{ asset('plugins/sweetalerts/sweetalert2.min.js') }}"></script>

 <script src="{{ asset('plugins/notification/snackbar/snackbar.min.js') }}"></script>
 <script src="{{ asset('plugins/nicescroll/nicescroll.min.js') }}"></script>
 <script src="{{ asset('plugins/currency/currency.js') }}"></script>
 <!-- loaders-->
 <script>
    function noty(msg, option = 1)
{
	Snackbar.show({
        text: msg.toUpperCase(),
        actionText: 'CERRAR',
        actionTextColor: '#fff',
        backgroundColor: option == 1 ? '#3b3f5c' : '#e7515a',
        pos: 'top-right'
	});
}
 </script>
 <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

 <script src="{{ asset('plugins/flatpickr/flatpickr.js') }}"></script>    

 <!-- select2 -->
 <script src="{{ asset('plugins/select2/select2.min.js') }}"></script>   
 <script src="{{ asset('plugins/select2/custom-select2.js') }}"></script>   

  <!-- select -->
  <script src="assets/js/scrollspyNav.js"></script>
 
    <script src=" {{ asset('plugins/bootstrap-select/bootstrap-select.min.js') }}"></script>

 @livewireScripts
