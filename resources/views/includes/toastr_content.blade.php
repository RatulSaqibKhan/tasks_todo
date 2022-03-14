<div class="alert border-0 alert-dismissible fade show py-2">
  <div class="d-flex align-items-center">
    <div class="font-35 text-white"><i class='{{ $iconClass ?? "bx bxs-message-square-x"}}'></i>
    </div>
    <div class="ms-3">
      <h6 class="mb-0 text-white">{{ $primaryMessage ?? 'Danger Alerts' }}</h6>
      <div class="text-white">{{ $secondaryMessage ?? "A simple danger alert—check it out!" }}</div>
    </div>
  </div>
  <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
</div>