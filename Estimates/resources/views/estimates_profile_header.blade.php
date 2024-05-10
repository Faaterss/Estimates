{{-- breadcrumb --}}
<div class="row">
    <div class="col-md-12">
        <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4">
            <div class="card-body px-4 py-3">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h4 class="fw-semibold mb-8">Estimates</h4>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="/">Home</a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a class="text-muted text-decoration-none" href="/estimates">Estimates</a>
                                </li>
                                <li class="breadcrumb-item" aria-current="page">Estimates profile</li>
                            </ol>
                        </nav>
                    </div>
                    <div class="col-3">
                        <div class="text-center mb-n5">
                            <i class="{{ $aimx['icon'] }} text-white" style="font-size: 9rem !important;"></i>
                            <img src="../assets/images/breadcrumb/ChatBc.png" alt="" class="img-fluid mb-n4">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="row">
                <div class="col-md-6">
                    <ul class="nav nav-pills user-profile-tab">
                        <li class="nav-item" role="presentation">
                          <a class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4 {{ $tab == 'overview' ? 'active' : '' }}" href="/estimates/profile/{{ $estimate->id }}">
                            <i class="ti ti-file-time me-2 fs-6"></i>
                            <span class="d-none d-md-block">Overview</span>
                          </a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4 {{ $tab == 'items' ? 'active' : '' }}" href="/estimates/profile/{{ $estimate->id }}/items">
                            <i class="ti ti-list-details me-2 fs-6"></i>
                            <span class="d-none d-md-block">Items</span>
                          </a>
                        </li>
                        <li class="nav-item" role="presentation">
                          <a class="nav-link position-relative rounded-0 d-flex align-items-center justify-content-center bg-transparent fs-3 py-4 {{ $tab == 'import' ? 'active' : '' }}" href="/estimates/profile/{{ $estimate->id }}/import">
                            <i class="ti ti-file-import me-2 fs-6"></i>
                            <span class="d-none d-md-block">Import</span>
                          </a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-6 text-end">
                    <div class="p-3">
                        <a href="#" data-request="onOpenAddItemModal" class="btn bg-primary-subtle text-primary px-2 me-2">
                            <i class="ti ti-plus"></i>
                            Add Item
                        </a>
                        <a class="btn bg-danger-subtle text-danger me-2 px-2" href="/estimates" data-request="onDelete" data-request-confirm="Are you sure you want to delete this Estimate?" data-request-data="id:{{$estimate->id}}">
                            <i class="ti ti-trash fs-6"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
