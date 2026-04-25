@if (session($status))
  <div class="alert alert-{{ $status }} alert-dismissible fade show mb-0" role="alert">
    <strong>{{ session($status) }}</strong>

    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
  </div>
@endif
