@extends('layouts.header')

@section('content')
    <div class="slider-area ">
        <div class="slider-active">
            <div class="single-slider slider-height hero-overly d-flex align-items-center" data-background="{{ asset('images/IMG_20211002_114535.jpg') }}">
                <div class="container">
                    @if (session('success'))
                        <div class="alert alert-success text-center mt-4 container">
                            {{ session('success') }}
                        </div>
                    @endif
                    <div class="row d-flex align-items-center">
                        <div class="col-lg-7 col-md-9 ">
                            <div class="hero__caption text-center d-flex align-items-center caption-bg">
                                <div class="circle-caption">
                                    <span  data-animation="fadeInUp" data-delay=".3s">4 Octubre 2025</span>
                                    <h1  data-animation="fadeInUp" data-delay=".5s">Paula & Jose</h1>
                                    <p  data-animation="fadeInUp" data-delay=".9s">Nos Casamos</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="Our-story-area story-padding">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="story-img mb-50">
                        <img src="{{ asset('images/IMG_20220415_200321.jpg') }}" class="story-imges" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="story-caption">
                        <img src="{{ asset('images/flower_right.png') }}" alt="">
                        <h3>Todo empezo con un match</h3>
                        <p class="story1">Todo empezó con un match, una chispa digital que encendió algo muy real. Nos conocimos en Tinder,
                            quedamos para cenar y desde esa primera cita supimos que había algo especial entre nosotros. Así comenzó nuestra historia.</p>
                        <p class="story2">Cuatro años después, con un hijo que es nuestro mayor regalo, hemos decidido dar el siguiente paso:
                            ¡nos casamos! Porque el amor verdadero no solo se encuentra, también se construye. 💕</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="shape-flower d-none d-xl-block">
            <img src="{{ asset('images/shape_left.png') }}" class="flower1" alt="">
            <img src="{{ asset('images/shape_right.png') }}" class="flower2 " alt="">
        </div>
    </div>

    <div class="gift-area gift-padding gift-overly" data-background="{{ asset('images/gft.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="gift-caption text-center">
                        <h2 class="mb-4">¡Nos casamos!</h2>
                        <h3 class="mb-4">Ya tenemos
                            el brindis, las copas, la cena y hasta quien las rompa!!</h3>
                        <p>Si queréis aportar algo a esta aventura, os lo agradeceremos
                            un montón</p>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center mt-3">
                    <a class="btn text-white" style="cursor: default;">ES00 0000 0000 0000 0000 0000</a>
                </div>
            </div>
        </div>
    </div>

    <div class="gift-area gift-padding gift-overly">
        <div class="container">
            <div class="row justify-content-center text-center">
                <div class="col-lg-12">
                    <div class="gift-caption">
                        <h2>Esperamos verte desde el altar.</h2>
                        <p>Solicitamos atentamente
                            tu respuesta antes del
                            15 de septiembre de 2025.</p>
                        <a href="#" class="btn" onclick="event.preventDefault(); document.getElementById('codigoModal').style.display = 'block'">Confirma tu asistencia</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="service-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="singl-services text-center mb-30">
                        <div class="top-caption">
                            <h4>Sé testigo de nuestro día</h4>
                            <p>4 de Octubre de 2025</p>
                        </div>
                        <div class="services-img">
                            <img src="{{ asset('images/cedropiscina2.png') }}" alt="">
                        </div>
                        <div class="bottom-caption">
                            <span>- 17:30 -</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="singl-services text-center mb-30">
                        <div class="top-caption">
                            <h4>El Coso (Burriana)</h4>
                            <p>Jardin el Cedro</p>
                        </div>
                        <div class="services-img">
                            <img src="{{ asset('images/jardincedro.png') }}" alt="">
                        </div>
                        <div class="bottom-caption">
                            <p>Camí del Palaciet<br> 12530 Borriana, Castelló</p>
                        </div>
                    </div>
                </div>
                <div class="col-12 d-flex justify-content-center mt-3">
                    <a href="https://maps.app.goo.gl/typfeeCBGb9QjeYT8" class="btn">Ver Ubicación</a>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal para introducir el código -->
    <div id="codigoModal">
        <div class="modal-content">
            <h3>Introduce tu código</h3>
                <div id="codigoError" class="mt-2"></div>

            <form id="codigoForm">
            @csrf
                <input type="text" name="codigo" placeholder="Escribe tu código" required />

                <div class="d-flex justify-content-between mt-4">
                    <button type="submit" class="btn btn-success">Aceptar</button>
                    <button type="button" class="btn btn-secondary" onclick="cerrarModal()">Cancelar</button>

                </div>
            </form>
        </div>
    </div>
@endsection
