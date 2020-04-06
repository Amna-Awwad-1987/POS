@if(session('success'))
    <script>
        new Noty({
            type: 'success',
            layout: 'topCenter',
            text: "{{session('success')}}",
            timeout: 2000,
            kill: true
        }).show();
    </script>
@endif
