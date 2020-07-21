<div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
    {{ $slot }}
    <button type="button" clase="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>