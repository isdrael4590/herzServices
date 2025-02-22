@php
    $Institute_max_id = \Modules\Informat\Entities\Institute::max('id') + 1;
    $institute_code = "Inst_" . str_pad($Institute_max_id, 2, '0', STR_PAD_LEFT)
@endphp
<div class="modal fade" id="InstituteCreateModal" tabindex="-1" role="dialog" aria-labelledby="InstituteCreateModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="InstituteCreateModalLabel">Crear Institución</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('institute.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label class="font-weight-bold" for="institute_code">Institución Código <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="institute_code" required value="{{ $institute_code }}">
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="institute_name">Nombre de la Institución <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="institute_name" required >
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="institute_address">Dirección Institución <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="institute_address" required>
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="institute_area">Área del Hospital<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="institute_area" required >
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="institute_city">Ciudad <span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="institute_city" required >
                    </div>
                    <div class="form-group">
                        <label class="font-weight-bold" for="institute_country">País<span class="text-danger">*</span></label>
                        <input class="form-control" type="text" name="institute_country" required >
                    </div>
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="image">Logo de la Institución. <i class="bi bi-question-circle-fill text-info" data-toggle="tooltip" data-placement="top" title="Max Files: 3, Max File Size: 1MB, Image Size: 400x400"></i></label>
                                    <div class="dropzone d-flex flex-wrap align-items-center justify-content-center" id="document-dropzone">
                                        <div class="dz-message" data-dz-message>
                                            <i class="bi bi-cloud-arrow-up"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Crear <i class="bi bi-check"></i></button>
                </div>
            </form>
        </div>
    </div>
</div>
@section('third_party_scripts')
    <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script>
    <script
        src="https://unpkg.com/filepond-plugin-file-validate-size/dist/filepond-plugin-file-validate-size.js"></script>
    <script
        src="https://unpkg.com/filepond-plugin-file-validate-type/dist/filepond-plugin-file-validate-type.js"></script>
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
@endsection
@push('page_scripts')
    <script>
        FilePond.registerPlugin(
            FilePondPluginImagePreview,
            FilePondPluginFileValidateSize,
            FilePondPluginFileValidateType
        );
        const fileElement = document.querySelector('input[id="image"]');
        const pond = FilePond.create(fileElement, {
            acceptedFileTypes: ['image/png', 'image/jpg', 'image/jpeg'],
        });
        FilePond.setOptions({
            server: {
                url: "{{ route('filepond.upload') }}",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                }
            }
        });
    </script>
@endpush