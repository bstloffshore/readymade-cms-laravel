<div class="modal-header">
    <h3 class="modal-title" id="ajaxModalLabel">Show Gallery</h3>
    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<div class="modal-body">
    <div>
        <img src="{{ asset('public/storage/gallery/large/') }}/{{ $gallery->image }}" height="400">
    </div>
  </div>

