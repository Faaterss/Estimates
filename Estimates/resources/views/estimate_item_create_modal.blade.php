<div>
    <div class="modal fade" id="estimates_create_item_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header text-center px-4">
                    <h4 class="modal-title" id="userDetailsModalLabel" style="width: 100%; text-align: left;"><strong>Add Item</strong></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="from" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="to" class="form-label">Unit</label>
                                    <input type="text" class="form-control" id="unit" name="unit">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="from" class="form-label">Unit Value</label>
                                    <input type="text" class="form-control" id="unit_value" name="unit_value">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="to" class="form-label">Work Quantity</label>
                                    <input type="text" class="form-control" id="work_q" name="work_q">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="from" class="form-label">Work Cost</label>
                                    <input type="text" class="form-control" id="work_cost" name="work_cost">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="to" class="form-label">Resource Cost</label>
                                    <input type="text" class="form-control" id="resource_cost" name="resource_cost">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="from" class="form-label">Mechanical Cost</label>
                                    <input type="text" class="form-control" id="mech_cost" name="mech_cost">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="to" class="form-label">Other Cost</label>
                                    <input type="text" class="form-control" id="other_cost" name="other_cost">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="to" class="form-label">Total Cost</label>
                                    <input type="text" class="form-control" id="total_cost" name="total_cost">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="text-center">
                                <button type="button" class="btn btn-primary my-4" data-request="onStoreItem">
                                    <i class="ti ti-check me-1"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#estimates_create_item_modal').modal('show');
</script>

