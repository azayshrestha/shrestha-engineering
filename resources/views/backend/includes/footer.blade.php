<!-- Main Footer -->
{{--<footer class="main-footer">--}}
    {{--<!-- To the right -->--}}
    {{--<div class="float-right d-none d-sm-inline">--}}
        {{--Anything you want--}}
    {{--</div>--}}
    {{--<!-- Default to the left -->--}}
    {{--<strong>Copyright &copy; 2014-2019 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.--}}
{{--</footer>--}}
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="{{asset('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('dist/js/adminlte.min.js')}}"></script>
<script src="{{asset('plugins/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
@yield('script')
<script>
    $(document).ready( function () {
        $('.dtable').DataTable({
            "pageLength": 50,
            "lengthMenu": [[10,25,50,75,100,-1], [10,25,50,75,100,"All"]]
        });

        $('.textarea').summernote({
            placeholder: "Place some text here",
            height: 400,
            width: '100%',
            toolbar: [
                ['style', ['style']],
                ['font', ['bold', 'underline', 'clear']],
                ['color', ['color']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['codeview']]
            ]
        });
    })
</script>
</body>
</html>