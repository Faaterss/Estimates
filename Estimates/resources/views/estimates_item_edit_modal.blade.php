<div>
    <div class="modal fade" id="estimates_item_edit_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="userDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
                <div class="modal-header text-center px-4">
                    <h4 class="modal-title" id="userDetailsModalLabel" style="width: 100%; text-align: left;"><strong>Edit Item</strong></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form>
                        <input type="hidden" name="ItemId" value="{{ $estimate->id}}">
                        <input type="hidden" class="form-control" id="estimate_id" name="estimate_id" value="{{$estimate->estimate_id}}">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="from" class="form-label">Title</label>
                                    <input type="text" class="form-control" id="title" name="title" value="{{$estimate->title}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="to" class="form-label">Unit</label>
                                    <input type="text" class="form-control" id="unit" name="unit" value="{{$estimate->unit_id}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="from" class="form-label">Unit Value</label>
                                    <input type="text" class="form-control" id="unit_value" name="unit_value" value="{{$estimate->unit_value}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="to" class="form-label">Work Quantity</label>
                                    <input type="text" class="form-control" id="work_q" name="work_q" value="{{$estimate->work_quantity}}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="from" class="form-label">Work Cost</label>
                                    <input type="text" class="form-control" id="work_cost" name="work_cost" value="{{$estimate->work_cost}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="to" class="form-label">Resource Cost</label>
                                    <input type="text" class="form-control" id="resource_cost" name="resource_cost" value="{{$estimate->resource_cost}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="from" class="form-label">Mechanical Cost</label>
                                    <input type="text" class="form-control" id="mech_cost" name="mech_cost" value="{{$estimate->mechanical_cost}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="to" class="form-label">Other Cost</label>
                                    <input type="text" class="form-control" id="other_cost" name="other_cost" value="{{$estimate->other_cost}}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-3">
                                    <label for="to" class="form-label">Total Cost</label>
                                    <input type="text" class="form-control" id="total_cost" name="total_cost" value="{{$estimate->total_cost}}">
                                </div>
                            </div>
                        </div>
                        <div class="row justify-content-center">
                            <div class="text-center">
                                <button type="button" class="btn btn-primary my-4" data-request="onSaveItem">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#estimates_item_edit_modal').modal('show');
</script>

