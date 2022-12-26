<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="modalLabel">
                    {{-- TEXT AKAN DI ISI OLEH JQUERY --}}
                </h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="preview_avatar" class="container mt-3 mb-2 justify-content-center d-none">
                <img id="preview_avatar" class="rounded-circle img-fluid shadow"
                    style="width: 150px; height: 150px; object-fit: cover;">
            </div>
            <form id="modalForm" method="POST">
                @csrf
                <div class="modal-body text-center">
                    <div class="mb-3 inputModal">
                        {{-- HTML AKAN DI ISI OLEH JQUERY --}}
                    </div>
                </div>
                <div class="modal-footer">
                    @isset(auth()->user()->avatar)
                        <div id="remove_avatar_div">
                            {{-- HTML AKAN DI ISI OLEH JQUERY --}}
                        </div>
                    @endisset
                    <button id="save_btn" type="submit" class="save-btn btn btn-primary"><i
                            class="fa-solid fa-floppy-disk"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
