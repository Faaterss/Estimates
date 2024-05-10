<div class="row">
    <div class="col-md-12">
        <div class="card p-4">
            <form>
                <div class="row">                   
                    <div class="col-md-6">
                        <h4>File Upload</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="input-group">
                            
                            <input type="file" id="file" name="file" class="form-control" placeholder="Right Side" value="{{ isset($inputValues['file']) ? $inputValues['file'] : '' }}">
                            <button class="btn btn-primary font-medium" type="button" data-request-files='1' method="POST" accept-charset="UTF-8" data-request="onImportData">Import</button>
                        </div>
                    </div>
                    <div class="col-md-12 mt-4">
                        <h5>Input</h5>
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="from" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{ isset($inputValues['title']) ? $inputValues['title'] : '' }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="from" class="form-label">Unit</label>
                                    <input type="text" class="form-control" id="unit" name="unit" value="{{ isset($inputValues['unit']) ? $inputValues['unit'] : '' }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="from" class="form-label">Unit Value</label>
                                    <input type="text" class="form-control" id="unit_value" name="unit_value" value="{{ isset($inputValues['unit_value']) ? $inputValues['unit_value'] : '' }}">
                                </div>
                            </div>
                            <div class="col">
                                <div class="mb-3">
                                    <label for="from" class="form-label">Range</label>
                                    <input type="text" class="form-control" id="row_range" name="row_range" value="{{ isset($inputValues['row_range']) ? $inputValues['row_range'] : '' }}">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <form action="">
        <div class="card p-4" type="hidden" id="importListDiv" hidden>
            <div class="row mb-3">
                <div class="col-md-6">
                    <h5>Imported Items</h5>
                </div>
                
                <div class="col-md-6 text-end">
                    <div>
                        <a class="btn btn-primary px-2 me-2" data-request="onManageImportList" data-request-data="action:'save'">
                            Save To Table
                        </a>
                        <a class="btn bg-danger-subtle text-danger me-2 px-2" title="Clear List" data-request="onManageImportList" data-request-data="action:'clear'" data-request-confirm="Are you sure you want to clear list?">
                            <i class="ti ti-trash fs-6"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div style="max-height: 500px; overflow-y: auto;">
                <div class="table-responsive" style="overflow-x: hidden;">
                    <table class="table table-nowrap table-hover table-align-middle">
                        <thead class="thead-light">
                            <tr>
                                <th>{{ 'Title' }}</th>
                                <th>{{ 'Unit' }}</th>
                                <th>{{ 'Unit Value' }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($itemArray as $item)
                            <input type="text" name="items[{{ $item->id }}][title]" hidden value="{{ $item->title }}">
                            <input type="text" name="items[{{ $item->id }}][unit_id]" hidden value="{{ $item->unit_id }}">
                            <input type="text" name="items[{{ $item->id }}][unit_value]" hidden value="{{ $item->unit_value }}">
                            <tr>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->unit_id }}</td>
                                <td>{{ $item->unit_value }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </form>
    </div>
</div>
<script>
    function onShowList() {
        var importListDiv = document.getElementById('importListDiv');
        importListDiv.removeAttribute('hidden');
    }

    function onHideList() {
        var importListDiv = document.getElementById('importListDiv');
        importListDiv.setAttribute('hidden', true);
    }
</script>
