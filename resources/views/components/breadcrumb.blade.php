<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
  <div class="breadcrumb-title pe-3">{{ $title }}</div>
  <div class="ps-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb-0 p-0">
        <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="bx bx-home-alt"></i></a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">{{ $pageName }}</li>
      </ol>
    </nav>
  </div>
  <div class="ms-auto {{ $buttonClass ?? '' }}">
    <div class="btn-group">
      <button type="button" class="btn btn-light">Actions</button>
      <button type="button" class="btn btn-light dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
      </button>
      <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">
        <a class="dropdown-item" id="create-btn" href="{{ $buttonLink ?? 'javascript:;' }}">{{ $buttonName ?? 'Create New'}}</a>
      </div>
    </div>
  </div>
</div>