<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    @include('partials.css-links')
    <style>
        .mandatory,.error {
            color: red;
        }

        </style>

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    @yield('meta')
</head>
<body class="hold-transition sidebar-mini layout-fixed">
    <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('public/vendor/adminlte/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>
    <!-- Navbar -->
    @include('partials.navbar')
    <!-- /.navbar -->
      <!-- Main Sidebar Container -->
      @include('partials.sidebar')
        <!-- / .Main Sidebar Container -->
          <!-- Content Wrapper. Contains page content -->
          <div class="content-wrapper">
            @yield('content')
          </div>
            <!-- / .Content Wrapper. Contains page content -->

            <footer class="main-footer">
                <strong>Copyright &copy; 2024 <a href="#">BSTL CMS</a>.</strong> All rights reserved.
                <div class="float-right d-none d-sm-inline-block"></div>
              </footer>

 @include('partials.js-links')
 <script>
    function updateStatus(checkbox,id,modelClassName)
        {
            var token = document.head.querySelector('meta[name="csrf-token"]').content;
            var status = checkbox ? 'on' : 'off';
            if(confirm('Are you sure to wanth to change status? This cannot be undone.')) {
                $('#prepagemessage').show();
                $.ajax({
                    url: '{{route('status.changeStatus')}}',
                    type: 'POST',
                    data: {id:id,status:status,modelClassName:modelClassName,_token:token},
                    dataType: 'json',
                    //headers: {'X-CSRF-TOKEN': token},
                    success: function(res){
                        $('#prepagemessage').hide();
                        if(!res.error){
                            toastr.success(res.msg);
                            setTimeout(function() {
                            window.location.reload();
                            }, 2000);
                        } else {
                            toastr.error(res.msg);
                        }
                    },
                    error: function(res){
                        $('#prepagemessage').hide();
                        toastr.error('There was a problem while updating status. Please try later.');
                    },
                    fail: function(res){
                        $('#prepagemessage').hide();
                        toastr.error('There was a problem while updating status. Please try later.');
                    },
                });
            }

            return false;
        }

        // sort order
        // Get the input element
        var sort = document.getElementById('sort_order');
        // Listen for input event
        if(sort)
        {
        sort.addEventListener('input', function(event) {
        // Remove non-numeric characters using regular expression
        this.value = this.value.replace(/[^0-9]/g, '');
        });
        }


        $(function(){
            toastr.options = {
                "positionClass": "toast-top-center"
            };
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('body').on('hidden.bs.modal', function(e) {
                //$(e.target).removeData('bs.modal').find('.modal-content').empty();
                $(e.target).removeData('bs.modal').find('.modal-content').html('<p class="text-center">\n' +
                    '<img src="{{ asset('public/loading.gif') }}" align="center" width=50;height=50; class="img-responsive">\n'+
                    '</p>');
            });

            $('#ajaxModal').on('show.bs.modal', function (event) {
                var route = $(event.relatedTarget) // Button that triggered the modal
                var modal = $(this);
                modal.find('.modal-content').load(route.attr('href'));
            });

            $('#ajaxModalOfSmall').on('show.bs.modal', function (event) {
                var route = $(event.relatedTarget) // Button that triggered the modal
                var modal = $(this);
                modal.find('.modal-content').load(route.attr('href'));
            });


        });

        $(function () {
    $(document).on('click', '[data-toggle="lightbox"]', function(event) {
      event.preventDefault();
      $(this).ekkoLightbox({
        alwaysShowClose: true
      });
    });

    $('.filter-container').filterizr({gutterPixels: 3});
    $('.btn[data-filter]').on('click', function() {
      $('.btn[data-filter]').removeClass('active');
      $(this).addClass('active');
    });


  })

    </script>

<script>
    function previewImage(event) {
        var input = event.target;
        var previewContainer = document.getElementById('previewContainer');
        previewContainer.innerHTML = '';

        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                var imgElement = document.createElement('img');
                imgElement.setAttribute('src', e.target.result);
                imgElement.setAttribute('class', 'img-fluid');
                previewContainer.appendChild(imgElement);
                $('.cancelButton').show();
            }

            reader.readAsDataURL(input.files[0]);
        }
    }

    function cancelPreview() {
        var previewContainer = document.getElementById('previewContainer');
        previewContainer.innerHTML = '';
    }
    </script>

<div class="modal fade" id="ajaxModalOfSmall"  tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog">
        <div class="modal-content"></div></div>
</div>
<div class="modal fade" id="ajaxModal"  tabindex="-1" role="dialog" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content"></div></div>
</div>
@yield('scripts')

</body>
</html>
