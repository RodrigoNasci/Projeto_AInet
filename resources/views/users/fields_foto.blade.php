<img src="{{ $user->fullPhotoUrl }}" alt="Avatar" class="rounded-circle img-thumbnail">
@if ($allowUpload)
    <div class="mb-3 pt-3">
        <input type="file" class="form-control @error('file_foto') is-invalid @enderror" name="file_foto"
            id="inputFileFoto">
        @error('file_foto')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror
    </div>
@endif
@if (($allowDelete ?? false) && $user->url_foto)
    @if ($user->docente)
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal"
            data-action="{{ route('docentes.foto.destroy', ['docente' => $user->docente]) }}"
            data-msgLine2="Quer realmente apagar a fotografia do docente <strong>{{ $user->name }}</strong>?">
            Apagar Foto
        </button>
    @elseif ($user->aluno)
        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmationModal"
            data-action="{{ route('alunos.foto.destroy', ['aluno' => $user->aluno]) }}"
            data-msgLine2="Quer realmente apagar a fotografia do aluno <strong>{{ $user->name }}</strong>?">
            Apagar Foto
        </button>
    @endif
@endif
