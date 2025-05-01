<h1>Sección: {{ $seccion->nombre }} - {{ $seccion->seccion }} </h1>

<h3>Alumnos inscritos</h3>
<ul>
  @foreach($seccion->alumnos as $a)
    <li>{{ $a->nombre }} ({{ $a->codigo }})</li>
  @endforeach
  @if($seccion->alumnos->isEmpty())
    <li><em>No hay alumnos inscritos.</em></li>
  @endif
</ul>

<hr>

<h3>Asignar Alumnos</h3>
<form action="{{ route('seccion.asignar-alumnos', $seccion) }}" method="POST">
  @csrf
  <div class="form-group">
    <label for="alumnos">Selecciona Alumnos</label>
    <select name="alumnos[]" id="alumnos" class="form-control" multiple>
      @foreach($alumnos as $a)
        <option value="{{ $a->id }}"
          {{ in_array($a->id, $inscritos) ? 'selected' : '' }}>
          {{ $a->nombre }} ({{ $a->codigo }})
        </option>
      @endforeach
    </select>
  </div>
  <button type="submit" class="btn btn-success mt-2">Guardar</button>
</form>