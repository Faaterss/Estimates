<div>
    <div class="modal fade" id="estimate_create_modal" data-bs-backdrop="static" tabindex="-1" aria-labelledby="estimate_create_modal" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header text-center px-4">
                    <h4 class="modal-title" id="userDetailsModalLabel" style="width: 100%; text-align: left;"><strong>Add Estimate</strong></h4>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4">
                    <form>
                        <div class="col-md-12 mt-3">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Title</label>
                                        <input type="text" class="form-control" placeholder="Title" name="title" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Status</label>
                                        <select class="form-select" name="status" required>
                                            @foreach($statusTypes as $key => $status)
                                                <option>
                                                    {{ $status['title'] }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Employee</label>
                                        <select class="form-select" name="employee_id" id="employee_id" required>
                                            <option selected disabled>Select Employee</option>
                                            @foreach($employees as $employee)
                                                <option value="{{ $employee->id }}">
                                                    {{ $employee->first_name }} {{ $employee->last_name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Client</label>
                                        <select class="form-select"  name="client_id" id="client_id" required>
                                            <option selected disabled>Select Client</option>
                                            @foreach($clients as $client)
                                                <option value="{{ $client->id }}" data-email="{{ $client->email }}" data-phone="{{ $client->phone }}">{{ $client->title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Email</label>
                                        <input type="text" class="form-control" placeholder="Email" name="email" id="client_email" readonly>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Phone</label>
                                        <input type="text" class="form-control" placeholder="Phone" name="phone" id="client_phone" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Tax</label>
                                        <input type="number" class="form-control" placeholder="Tax" name="tax" required>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Discount</label>
                                        <input type="number" class="form-control" placeholder="Discount" name="discount" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label class="form-label fw-semibold">Total</label>
                                        <input type="number" class="form-control" placeholder="Total" name="in_total" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col text-center">
                                <button data-request="onStoreEstimate" class="btn btn-primary">
                                    <i class="ti ti-circle-check me-1"></i>
                                    Create
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
    $(document).ready(function() {
        $('#client_id').change(function() {
            var selectedClient = $(this).find(':selected');
            var clientEmail = selectedClient.data('email');
            var clientPhone = selectedClient.data('phone');
            $('#client_email').val(clientEmail);
            $('#client_phone').val(clientPhone);
        });
    });
    $('#estimate_create_modal').modal('show');
</script>
