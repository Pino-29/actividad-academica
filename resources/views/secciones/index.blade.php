{{-- @extends('layouts.app')

@section('content') --}}
<h1>Secciones</h1>
{{-- <a href="{{ route('seccion.create') }}" class="btn btn-primary">Nueva Sección</a> --}}
<table class="table mt-3">
  <thead>
    <tr><th>ID</th><th>Nombre</th><th>Acciones</th></tr>
  </thead>
  <tbody>
    @foreach($secciones as $s)
    <tr>
      <td>{{ $s->id }}</td>
      <td>{{ $s->nombre }}</td>
      <td>
        <a href="{{ route('seccion.show', $s) }}" class="btn btn-sm btn-info">Ver</a>
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
{{-- @endsection --}}