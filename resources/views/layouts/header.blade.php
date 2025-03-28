<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Boda Paula y José') }}</title>

    <!-- Scripts -->


    <!-- Fonts -->

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/flaticon.css') }}">
    <link rel="stylesheet" href="{{ asset('css/gijgo.css') }}">
    <link rel="stylesheet" href="{{ asset('css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('css/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('css/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('css/slicknav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/responsive.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

</head>
<body>
<div id="app">
    <main class="p-0 m-0">
        @yield('content')
    </main>
</div>
<!-- All JS Custom Plugins Link Here -->
<script src="{{ asset('js/vendor/modernizr-3.5.0.min.js') }}"></script>

<!-- Jquery, Popper, Bootstrap -->
<script src="{{ asset('js/vendor/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('js/popper.min.js') }}"></script>
<script src="{{ asset('js/bootstrap.min.js') }}"></script>

<!-- Jquery Mobile Menu -->
<script src="{{ asset('js/jquery.slicknav.min.js') }}"></script>

<!-- Jquery Slick , Owl-Carousel Plugins -->
<script src="{{ asset('js/owl.carousel.min.js') }}"></script>
<script src="{{ asset('js/slick.min.js') }}"></script>

<!-- Date Picker -->
<script src="{{ asset('js/gijgo.min.js') }}"></script>

<!-- One Page, Animated-HeadLine -->
<script src="{{ asset('js/wow.min.js') }}"></script>
<script src="{{ asset('js/animated.headline.js') }}"></script>
<script src="{{ asset('js/jquery.magnific-popup.js') }}"></script>

<!-- Scrollup, nice-select, sticky -->
<script src="{{ asset('js/jquery.scrollUp.min.js') }}"></script>
<script src="{{ asset('js/jquery.nice-select.min.js') }}"></script>
<script src="{{ asset('js/jquery.sticky.js') }}"></script>

<!-- Contact JS -->
<script src="{{ asset('js/contact.js') }}"></script>
<script src="{{ asset('js/jquery.form.js') }}"></script>
<script src="{{ asset('js/jquery.validate.min.js') }}"></script>
<script src="{{ asset('js/mail-script.js') }}"></script>
<script src="{{ asset('js/jquery.ajaxchimp.min.js') }}"></script>

<!-- Jquery Plugins, main Jquery -->
<script src="{{ asset('js/plugins.js') }}"></script>
<script src="{{ asset('js/main.js') }}"></script>

<script>
    document.getElementById('codigoForm').addEventListener('submit', function(e) {
        e.preventDefault(); // Evita recargar

        const codigo = this.codigo.value;
        const errorDiv = document.getElementById('codigoError');
        errorDiv.innerText = '';
        errorDiv.className = '';

        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch("{{ route('verificar.codigo') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': token
            },
            body: JSON.stringify({ codigo })
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.success && data.redirect_url) {
                    const urlParts = data.redirect_url.split('/');
                    const invitadoId = urlParts[urlParts.length - 1];
                    localStorage.setItem('invitado_id_autorizado', invitadoId);

                    window.location.href = data.redirect_url;
                } else {
                    errorDiv.innerText = data.message || 'Código incorrecto.';
                    errorDiv.className = 'alert alert-danger';
                }
            })
            .catch(() => {
                errorDiv.innerText = 'Error al verificar el código. Inténtalo más tarde.';
                errorDiv.className = 'alert alert-danger';
            });
    });

    function cerrarModal() {
        const modal = document.getElementById('codigoModal');
        const input = document.querySelector('#codigoForm input[name="codigo"]');
        const errorDiv = document.getElementById('codigoError');

        // Oculta el modal
        modal.style.display = 'none';

        // Limpia el input
        input.value = '';

        // Limpia el error
        errorDiv.innerText = '';
        errorDiv.className = '';
    }
</script>



</body>
</html>


