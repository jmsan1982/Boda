@extends('layouts.header')

@section('content')
    <div class="gift-area gift-padding gift-overly" style="background-color: #f8f1e4;">
        <div class="container">
            @if ($invitado->confirmado && !$invitado->no_asistira)
                <div class="alert alert-info text-center mt-4">
                    Ya has confirmado tu asistencia. ¿Deseas hacer cambios?
                </div>
            @endif
            @if ($invitado->no_asistira)
                <div class="alert alert-warning text-center mt-4">
                    Nos dijiste que no podrías venir. ¿Quieres cambiar tu respuesta?
                </div>
            @endif
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="gift-caption text-center text-white">
                        <h2 class="mb-4">Hola {{ $invitado->nombre }},</h2>
                        <h3 class="mb-4">Confirma tu asistencia</h3>
                        @if ($caducado)
                            <div class="alert alert-warning text-center mt-4">
                                🕒 El tiempo para confirmar asistencia ha terminado. <br>
                                Por favor, contacta con Paula o José para ver si todavía hay hueco.
                            </div>
                            <div class="text-center mt-4 d-flex justify-content-center gap-3 flex-wrap">
                                <button type="button" class="btn boton-asistencia boton-cancelar"
                                        onclick="window.location.href='{{ url('/') }}'">
                                    Cancelar
                                </button>
                            </div>
                        @else
                            <form action="{{ route('guardar.confirmacion', ['invitado' => $invitado->id]) }}"
                                  method="POST">
                                @csrf

                                <div class="form-check mb-3 text-start">
                                    @if (session('error'))
                                        <div class="text-danger small mt-2">{{ session('error') }}</div>
                                    @endif
                                    <input class="form-check-input" type="checkbox" id="yo_asistire" name="yo_asistire"
                                           onchange="eliminarNoAsistire()" {{ old('yo_asistire') || (!$invitado->no_asistira) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-bold text-success" for="yo_asistire">
                                        Sí, yo asistiré 😊
                                    </label>
                                </div>

                                <div class="form-check mb-3 text-start">
                                    <input class="form-check-input" type="checkbox" id="viene_pareja"
                                           name="viene_pareja" {{ old('viene_pareja', $invitado->viene_pareja) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="viene_pareja">Iré con acompañante</label>
                                </div>

                                <div class="mb-3 text-start">
                                    <label for="nombre_pareja" class="form-label">Nombre de tu acompañante:</label>
                                    <input type="text" class="form-control" name="nombre_pareja" id="nombre_pareja"
                                           value="{{ old('nombre_pareja', $invitado->nombre_pareja) }}">
                                    @error('nombre_pareja')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-check mb-3 text-start">
                                    <input class="form-check-input" type="checkbox" id="viene_hijos" name="viene_hijos"
                                           onchange="toggleHijosFields()" {{ old('viene_hijos', $invitado->viene_hijos) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="viene_hijos">Iré con mis hijos</label>
                                </div>

                                <div class="mb-3 text-start" id="numeroHijosField" style="display: none;">
                                    <label for="numero_hijos" class="form-label">¿Cuántos hijos vienen?</label>
                                    <input type="number" class="form-control" name="numero_hijos" id="numero_hijos"
                                           min="1"
                                           max="10" value="{{ old('numero_hijos', $invitado->numero_hijos) }}">
                                    @error('numero_hijos')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="mb-3 text-start" id="nombresHijosField" style="display: none;">
                                    <label for="nombres_hijos" class="form-label">Nombres de tus hijos (separados por
                                        coma):</label>
                                    <input type="text" class="form-control" name="nombres_hijos" id="nombres_hijos"
                                           placeholder="Ej: Lucas, Marta"
                                           value="{{ old('nombres_hijos', $invitado->nombres_hijos) }}">
                                    @error('nombres_hijos')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                    @enderror
                                </div>


                                <div class="mb-3 text-start">
                                    <label for="comentarios" class="form-label">Comentarios adicionales:</label>
                                    <textarea class="form-control" name="comentarios" id="comentarios"
                                              rows="3">{{ old('comentarios', $invitado->comentarios) }}</textarea>
                                </div>

                                <div class="form-check mb-4 text-start" id="noAsistire">
                                    <input class="form-check-input" type="checkbox" id="no_asistira" name="no_asistira"
                                           {{ old('no_asistira', $invitado->no_asistira) ? 'checked' : '' }} onchange="toggleNoAsistencia()">
                                    <label class="form-check-label text-danger fw-bold" for="no_asistira">
                                        No podremos asistir, lo siento 😢
                                    </label>
                                </div>

                                <div class="text-center mt-4 d-flex justify-content-center gap-3 flex-wrap">
                                    <button type="submit" class="btn boton-asistencia me-3">
                                        Confirmar asistencia
                                    </button>

                                    <button type="button" class="btn boton-asistencia boton-cancelar"
                                            onclick="window.location.href='{{ url('/') }}'">
                                        Cancelar
                                    </button>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        const idRuta = "{{ $invitado->id }}";
        const idAutorizado = localStorage.getItem('invitado_id_autorizado');

        if (idRuta !== idAutorizado) {
            alert('Acceso no autorizado. Debes introducir tu código primero.');
            window.location.href = '/';
        }

        function toggleHijosFields() {
            const vieneHijos = document.getElementById('viene_hijos').checked;
            const numeroHijosField = document.getElementById('numeroHijosField');
            const nombresHijosField = document.getElementById('nombresHijosField');

            const numeroHijos = document.getElementById('numero_hijos');
            const nombresHijos = document.getElementById('nombres_hijos');

            if (vieneHijos) {
                numeroHijosField.style.display = 'block';
                nombresHijosField.style.display = 'block';

                numeroHijos.setAttribute('required', 'required');
                nombresHijos.setAttribute('required', 'required');
            } else {
                numeroHijosField.style.display = 'none';
                nombresHijosField.style.display = 'none';

                numeroHijos.removeAttribute('required');
                nombresHijos.removeAttribute('required');

                // ⚠️ Vacía el contenido y limpia error interno
                numeroHijos.value = '';
                nombresHijos.value = '';
                numeroHijos.setCustomValidity('');
            }
        }


        // Por si vuelve con datos rellenados
        window.onload = function () {
            toggleHijosFields();
        };

        function toggleNoAsistencia() {
            const noAsistira = document.getElementById('no_asistira').checked;

            const camposOpcionales = [
                'yo_asistire',
                'viene_pareja',
                'nombre_pareja',
                'viene_hijos',
                'numero_hijos',
                'nombres_hijos',
                'comentarios'
            ];

            camposOpcionales.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    if (noAsistira) {
                        if (el.type === 'checkbox') el.checked = false;
                        else el.value = '';
                        el.closest('.mb-3, .form-check').style.display = 'none';
                    } else {
                        el.closest('.mb-3, .form-check').style.display = 'block';
                    }
                }
            });

            toggleHijosFields();
        }

        function eliminarNoAsistire() {
            const yoAsistire = document.getElementById('yo_asistire');
            const divNoAsistire = document.getElementById('noAsistire');
            const checkboxNoAsistira = document.getElementById('no_asistira');

            if (!divNoAsistire) return;

            if (yoAsistire.checked) {
                divNoAsistire.style.display = 'none';
                checkboxNoAsistira.checked = false; // desmarcamos por si estaba marcado
            } else {
                divNoAsistire.style.display = 'block';
            }
        }


        // Asegura el estado inicial al recargar
        window.onload = function () {
            toggleNoAsistencia();
            toggleHijosFields();
            eliminarNoAsistire();
        };
    </script>
@endsection

