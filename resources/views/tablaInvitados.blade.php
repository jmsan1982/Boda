@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Tabla invitados</div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="tabla-invitados" class="table table-bordered table-striped text-center">
                                <thead class="table-dark">
                                <tr>
                                    <th>Nombre</th>
                                    <th>Código</th>
                                    <th>Confirmado</th>
                                    <th>No Asistirá</th>
                                    <th>Viene con Pareja</th>
                                    <th>Nombre Pareja</th>
                                    <th>Viene con Hijos</th>
                                    <th>Nº Hijos</th>
                                    <th>Nombres Hijos</th>
                                    <th>Comentarios</th>
                                    <th>Total Invitados</th>
                                    <th>Última actualización</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($invitados as $invitado)
                                    <tr>
                                        <td>{{ $invitado->nombre }}</td>
                                        <td>{{ $invitado->codigo }}</td>
                                        <td>{!! $invitado->confirmado ? '✅' : '❌' !!}</td>
                                        <td>{!! $invitado->no_asistira ? '✅' : '❌' !!}</td>
                                        <td>{!! $invitado->viene_pareja ? '✅' : '❌' !!}</td>
                                        <td>{{ $invitado->nombre_pareja ?? '-' }}</td>
                                        <td>{!! $invitado->viene_hijos ? '✅' : '❌' !!}</td>
                                        <td>{{ $invitado->numero_hijos }}</td>
                                        <td>{{ $invitado->nombres_hijos ?? '-' }}</td>
                                        <td>{{ $invitado->comentarios ?? '-' }}</td>
                                        <td>{{ $invitado->numero_invitados }}</td>
                                        <td>
                                            @if ($invitado->no_asistira)
                                                <span class="text-danger">No asistirá</span>
                                            @elseif ($invitado->confirmado)
                                                {{ $invitado->updated_at ? $invitado->updated_at->format('d/m/Y H:i') : '-' }}
                                            @else
                                                <span class="text-warning">Pendiente</span>
                                            @endif
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
