<script src="{{ asset('assets/js/loader.js') }}"></script>
<link href="{{ asset('assets/css/loader.css') }}" rel="stylesheet" type="text/css" />
<!-- BEGIN GLOBAL MANDATORY STYLES -->
 <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&display=swap" rel="stylesheet">
 <link href="{{asset('bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
 <link href="{{ asset('assets/css/plugins.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{ asset('assets/css/structure.css') }}" rel="stylesheet" type="text/css" class="structure" />
 <!-- END GLOBAL MANDATORY STYLES -->

 <link href="{{asset('plugins/font-icons/fontawesome/css/fontawesome.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{asset('css/fontawesome.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{asset('assets/css/elements/avatar.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{asset('plugins/sweetalerts/sweetalert.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{asset('plugins/notification/snackbar/snackbar.min.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{asset('css/custom.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{asset('assets/css/widgets/modules-widgets.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{asset('assets/css/forms/theme-checkbox-radio.css') }}" rel="stylesheet" type="text/css" />

 <link href="{{asset('assets/css/apps/scrumboard.css') }}" rel="stylesheet" type="text/css" />
 <link href="{{asset('assets/css/apps/notes.css') }}" rel="stylesheet" type="text/css" />
 <!-- loaders -->

 <link href="{{asset('plugins/loaders/custom-loader.css') }}" rel="stylesheet" type="text/css" />
 <!-- switches -->
 <link href="{{asset('assets/css/forms/switches.css') }}" rel="stylesheet" type="text/css" />
<!-- select2 -->
<link href="{{asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<!-- select --> 
<link href="{{asset('plugins/bootstrap-select/bootstrap-select.min.css') }}" rel="stylesheet" type="text/css" >

<style>
    aside{
        display: none!important;
    }
    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #3b3f5c;
        border-color: #3b3f5c;
    }

    @media (max-width: 480px)
    {
        .mtmobile{
            margin-bottom: 20px!important;
        }
        .mbmobile{
            margin-bottom: 10px!important;
        }
        .hideonsm{
            display: none!important;
        }
        .inblock{
            display: block;
        }
    }
    /*sidebar background*/
    .sidebar-theme #compactSidebar {
        background: #1d1e1e!important;
    }

    /*sidebar collapse background de la ambuerguesa*/
    .header-container .sidebarCollapse{
        color:#3b3f5c!important;
    }
    /*estilo del buscador principal*/
    .navbar .navbar-item .nav-item form.form-inline input.search-form-control {
    font-size: 15px;
    background-color: #3b3f5c!important;
    padding-right: 40px;
    padding-top: 12px;
    border: none;
    color: #FFF;
    box-shadow: none;
    border-radius: 30px;
    }
</style>

<link href="{{asset('plugins/flatpickr/dark.css') }}" rel="stylesheet" type="text/css" />

    @livewireStyles

