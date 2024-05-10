<div class="table-responsive">
    <table class="table table-nowrap table-hover table-align-middle">
        <thead class="thead-light">
            <tr>
                <th style="width: 250px;">{{ 'Title' }}</th>
                <th>{{ 'Unit' }}</th>
                <th>{{ 'Unit Value' }}</th>
                <th>{{ 'Work Quantity' }}</th>
                <th>{{ 'Work Cost' }}</th>
                <th>{{ 'Material Cost' }}</th>
                <th>{{ 'Mechanical Cost' }}</th>
                <th>{{ 'Other Cost' }}</th>
                <th>{{ 'Total Cost' }}</th>
                <th class="text-center">{{ 'Action' }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($estimateItems as $estimateItem)
                <tr id="list-row-{{ $estimateItem->id }}" data-request-data="estimateItem: {{ $estimateItem->id }}">
                    <td>{{ $estimateItem->title }}</td>
                    <td>{{ $estimateItem->unit_id }}</td>
                    <td>{{ $estimateItem->unit_value }}</td>
                    <td>{{ $estimateItem->work_quantity }}</td>
                    <td>{{ $estimateItem->work_cost }}</td>
                    <td>{{ $estimateItem->resource_cost }}</td>
                    <td>{{ $estimateItem->mechanical_cost }}</td>
                    <td>{{ $estimateItem->other_cost }}</td>
                    <td>{{ $estimateItem->total_cost }}</td>
                    <td style="" >
                        <div class="d-flex justify-content-center align-items-center" role="group">
                            <a class="btn bg-primary-subtle text-primary me-2 px-2" data-request="onOpenItemEditModal" data-request-data="id:'{{ $estimateItem->id }}'" data-bs-toggle="tooltip" title="Edit">
                                <i class="ti ti-file-time fs-6"></i>
                            </a>
                            <a class="btn bg-danger-subtle text-danger me-2 px-2" data-request="onDeleteItem" data-request-confirm="Are you sure you want to delete this item?" data-request-data="id:{{$estimateItem->id}}">
                                <i class="ti ti-trash fs-6"></i>
                            </a> 
                        </div>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="9"></td>
                <td class="fw-bold">In Total:&nbsp;{{ $total_sum }}</td>
            </tr>
        </tbody>
    </table>
</div>