@php $permissions = permission_list(); @endphp
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" rel="stylesheet">


    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>

    <header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand navbar-brand-name  col-md-3 col-lg-2 me-0 px-3" href="{{  url('/')  }}">{{
            config('app.name', 'Laravel')
            }}</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse"
            data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false"
            aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="navbar-nav">
            <div class="nav-item text-nowrap">
                <a class="nav-link px-3" href="{{ route('logout') }}"
                    onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout')
                    }}</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </div>
    </header>

    <div class="container-fluid">
        <div class="row">
            <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                <div class="position-sticky pt-3">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="{{ route('home') }}">
                                <i class="fa-solid fa-gauge"></i>
                                Dashboard
                            </a>
                        </li>
                        @if (in_array('users.index',$permissions))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="fa-solid fa-users"></i>
                                Users
                            </a>
                        </li>
                        @endif
                        @if (in_array('permission.index',$permissions))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('permission.index') }}">
                                <i class="fa-solid fa-hand-sparkles"></i>
                                Roles
                            </a>
                        </li>
                        @endif
                        @if (in_array('profile.view',$permissions))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('profile.view') }}">
                                <i class="fa-solid fa-user"></i>
                                My Profile
                            </a>
                        </li>
                        @endif
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div
                    class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><a href="{{ route('home') }}">Dashboard</a></h1>
                </div>

                @yield('content')

            </main>
        </div>
    </div>

    {{-- CDN List / I prefer saving them on our server than cdns --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

    {{-- Custom JS --}}
    <script type="text/javascript">
        var _url = "{{ url('') }}";
    var $alert_title = "{{ ('Are you sure?') }}";
    var $alert_message = "{{ ('Once deleted, you will not be able to recover this information !') }}";
    var $confirm_button_text = "{{ ('Yes, delete it!') }}";
    var $cancel_button_text = "{{ ('Cancel') }}";
    var $entries = "{{ ('Entries') }}";
    var $select_one = "{{ ('Select One') }}";
        (function ($) {
    "use strict";
    $(document).on("click", ".btn-remove", function () {
      //Sweet Alert for delete action
      Swal.fire({
        title: $alert_title,
        text: $alert_message,
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: $confirm_button_text,
        cancelButtonText: $cancel_button_text,
      }).then((result) => {
        if (result.value) {
          $(this).closest("form").submit();
        }
      });

      return false;
    });

    if (
      $("input:required, select:required, textarea:required")
        .closest(".form-group")
        .find(".required").length == 0
    ) {
      $("input:required, select:required, textarea:required")
        .closest(".form-group")
        .find("label")
        .append("<span class='required'> *</span>");
    }

    //Auto Selected
    if ($(".auto-select").length) {
      $(".auto-select").each(function (i, obj) {
        $(this).val($(this).data("selected")).trigger("change");
      });
    }

    //Roles and Permissions
    $(document).on("change", "#permissions #role_id", function () {
      showRole($(this));
    });

    $("#permissions .custom-control-input").each(function () {
      if ($(this).prop("checked") == true) {
        $(this).closest(".collapse").addClass("show");
      }
    });
  })(jQuery);

  function showRole(elem) {
    if ($(elem).val() == "") {
      return;
    }
    url = window.location.origin;
    window.location = url + "/permission/" + $(elem).val();
  }


    </script>


</body>

</html>
