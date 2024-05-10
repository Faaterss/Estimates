<form data-request="onSetFilters">
    
    <div class="row">
        <div class="col-md-12 mb-4">
            <label for="exampleInputtext" class="form-label fw-semibold">Title</label>
            <input type="text" class="form-control" name="filters[name][like]" value="{{ isset($filters['name']['like']) ? $filters['name']['like'] : '' }}">
        </div>
        
    </div>
    <div class="row">
        <div class="col-md-6 mb-4">
            <label for="filters[status]" class="form-label fw-semibold">Status</label>
            <select name="filters[status]" id="" class="form-select">
                <option value="">Select a status</option>
                @foreach ($filterOptions['statuses'] as $listItem)
                    <option value='{{$listItem->status}}'>
                        {{$listItem->status}}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6 mb-4">
            <label for="filters[client_id]" class="form-label fw-semibold">Client</label>
            <select name="filters[client_id]" id="" class="form-select">
                <option value="">Select a client</option>
                @foreach ($filterOptions['clients'] as $listItem )
                    <option value="{{$listItem->id}}"
                        @if (isset($filters['client_id']))
                        {{ $filters['client_id'] == $listItem->id ? 'selected' : '' }}
                        @endif>
                        
                        {{$listItem->title}}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-4">
            <label for="exampleInputtext" class="form-label fw-semibold">Employee</label>
            <select name="filters[employee_id]" id="" class="form-select">
                <option value="">Select an employee</option>
                @foreach ($filterOptions['employees'] as $listitem)
                    <option value="{{$listitem->id}}"
                        @if (isset($filters['employee_id']))
                        {{ $filters['employee_id'] == $listitem->id ? 'selected' : '' }}
                        @endif>
                        {{$listitem->first_name}} {{$listitem->last_name}}
                    </option>
                    
                @endforeach
            </select>
        </div>
        
    </div>

    <div class="row">
        <div class="col-md-6 text-end">
            <button type="reset" class="btn bg-secondary-subtle text-secondary">
                <i class="ti ti-reload"></i>
                Reset
            </button>
        </div>
        <div class="col-md-6 text-start">
            <button type="submit" class="btn btn-primary me-1">
                <i class="ti ti-adjustments"></i>
                Filter
            </button>
        </div>
    </div>
</form>
