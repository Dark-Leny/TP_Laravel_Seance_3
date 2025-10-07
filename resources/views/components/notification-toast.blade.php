@props(['type' => 'info', 'message', 'timeout' => 5000])

<div class="toast align-items-center text-bg-{{ $type }} border-0 position-fixed bottom-0 end-0 m-3" role="alert" aria-live="assertive" aria-atomic="true" data-timeout="{{ $timeout }}">
    <div class="d-flex">
        <div class="toast-body">
            @if($type === 'success') <i class="fas fa-check-circle"></i> @endif
            @if($type === 'error') <i class="fas fa-times-circle"></i> @endif
            @if($type === 'warning') <i class="fas fa-exclamation-triangle"></i> @endif
            @if($type === 'info') <i class="fas fa-info-circle"></i> @endif
            {{ $message }}
        </div>
        <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fermer"></button>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var toastElList = [].slice.call(document.querySelectorAll('.toast'));
        toastElList.forEach(function(toastEl) {
            var timeout = toastEl.getAttribute('data-timeout') || 5000;
            var toast = new bootstrap.Toast(toastEl, { delay: timeout });
            toast.show();
        });
    });
</script>
@endpush
