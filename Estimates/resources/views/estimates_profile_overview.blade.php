<form data-request="onSave">
    <div class="row">
        <div class="col-md-12 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h5 class="mb-3">Basic information</h5>
                        </div>
                    </div>
                    <div class="col-md-12 mt-3">
                        <div class="row">
                            <input type="hidden" class="form-control" placeholder="id" name="estimateId" value="{{ $estimate->id }}" required>
                            <div class="col-md-3">
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Title</label>
                                    <input type="text" class="form-control" placeholder="title" name="title" value="{{ $estimate->name }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Status</label>
                                    <select class="form-select" name="status" required>
                                        @foreach($statusTypes as $key => $status)
                                            <option value="{{ $key }}" {{ $estimate->status == $key ? 'selected' : '' }}>
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
                                        @foreach($employees as $employee)
                                            <option value="{{ $employee->id }}" {{ $estimate->employee_id == $employee->id ? 'selected' : '' }}>
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
                                    <select class="form-select"  name="client_id" required>
                                        <option value="{{$estimate->client->title}}"></option>
                                        @foreach($clients as $client)
                                            <option value="{{ $client->id }}" {{ $estimate->client_id == $client->id ? 'selected' : '' }}>{{ $client->title }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Email</label>
                                    <span class="form-control">{{ $estimate->client->email }}</span>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Phone</label>
                                    <span class="form-control">{{ $estimate->client->phone }}</span>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Tax</label>
                                    <input type="text" class="form-control" placeholder="tax" name="tax" value="{{ $estimate->tax }}" required>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Discount</label>
                                    <input type="integer" class="form-control" placeholder="discount" name="discount" value="{{ $estimate->discount }}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-4">
                                    <label class="form-label fw-semibold">Total</label>
                                    <input type="integer" class="form-control" placeholder="total" name="in_total" value="{{ $estimate->in_total }}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col text-center">
                            <button data-request="onSave" class="btn btn-primary">
                                <i class="ti ti-check me-1"></i>
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

