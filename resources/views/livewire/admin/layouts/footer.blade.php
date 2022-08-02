<div>


    <script src="/vendor/laravel-filemanager/js/stand-alone-button.js"></script>
    <!-- Bootstrap js-->
    <script src="{{asset('admin/plugins/bootstrap/js/popper.min.js')}}"></script>
    <script src="{{asset('admin/plugins/bootstrap/js/bootstrap-rtl.js')}}"></script>

    <!-- Perfect-scrollbar js -->
    <script src="{{asset('admin/plugins/perfect-scrollbar/perfect-scrollbar.min-rtl.js')}}"></script>

    <!-- Sidemenu js -->
    <script src="{{asset('admin/plugins/sidemenu/sidemenu-rtl.js')}}"></script>

    <!-- Sidebar js -->
    <script src="{{asset('admin/plugins/sidebar/sidebar-rtl.js')}}"></script>

{{--  <!-- Internal Jquery-Ui js-->
  <script src="{{asset('admin/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>

  <!-- Internal Jquery.maskedinput js-->
  <script src="{{asset('admin/plugins/jquery.maskedinput/jquery.maskedinput.js')}}"></script>

  <!-- Internal Specturm-colorpicker js-->
  <script src="{{asset('admin/plugins/spectrum-colorpicker/spectrum.js')}}"></script>

  <!-- Internal Ion-rangeslider js-->
  <script src="{{asset('admin/plugins/ion-rangeslider/js/ion.rangeSlider.min.js')}}"></script>--}}

<!-- Internal Form-elements js-->
    <script src="{{asset('admin/js/form-elements.js')}}"></script>

    <!-- Sticky js -->
    <script src="{{asset('admin/js/sticky.js')}}"></script>

    @stack('jsBeforCustomJs')

<!-- Custom js -->
    <script src="{{asset('admin/js/custom.js')}}"></script>
    <script>
        $(function() {
            $("#picture").on('click', function() {
                $("#fileinput").trigger('click');
            });
        });
    </script>


    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @stack('jsAfterCustomJs')
    <script>

        const Toast = Swal.mixin({
            toast: true,
            position: 'center',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        document.addEventListener('livewire:load', () => {
            Livewire.on('toast', (type, message) => {
                Toast.fire({
                    icon: type,
                    title: message
                })

            })
        })


    </script>
    @stack('modals')
    <livewire:scripts/>
    @stack('jsPanel')
</div>
