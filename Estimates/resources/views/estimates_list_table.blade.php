<div class="table-responsive">
    <table class="table table-nowrap table-hover table-align-middle">
        <thead class="thead-light">
            <tr>
                <th>
                   <input type="checkbox" class="form-check-input" id="list-select-all"> 
                </th>
                <th style="width: 170px;">{{ 'Title' }}</th>
                <th >{{ 'Status' }}</th>
                <th>{{ 'Client' }}</th>
                <th>{{ 'Contact' }}</th>
                <th>{{ 'Employee' }}</th>
                <th>{{ 'Tax' }}</th>
                <th>{{ 'Discount' }}</th>
                <th>{{ 'Total' }}</th>
                <th style="width: 50px;" class="text-end">{{ 'Action' }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($listItems as $listItem)
                <tr id="list-row-{{ $listItem->id }}" data-request-data="listItem: {{ $listItem->id }}">
                    <td>
                       <input type="checkbox" class="form-check-input" id="check-{{$listItem->id}}"> 
                    </td>

                    <td>
                        <a href="/estimates/profile/{{ $listItem->id }}">
                        <div class="d-flex align-items-center">
                            <div class="px-2">
                                <span class="bg-primary-subtle text-primary fw-semibold circle d-inline-flex align-items-center justify-content-center rounded-circle p-2" style="height: 32px; width: 32px;">
                                    <i class="ti ti-file-time fs-5"></i>
                                </span>
                            </div>                
                            <h6 class="mb-0">{{ $listItem->name }}</h6>   
                        </div>
                        </a>
                    </td>

                    <td>
                        <span class=" {{ isset($statusTypes[$listItem->status]) ? 'text-'.$statusTypes[$listItem->status]['text-color'] : 'text-muted' }} fw-semibold d-inline-flex justify-items-start align-items-center fs-2 gap-1">
                            <i class="{{ isset($statusTypes[$listItem->status]) ? $statusTypes[$listItem->status]['icon'] : 'fallback' }} fs-4"></i>
                            {{ $listItem->status }}
                        </span>
                    </td>
                    <td class="align-start" title="{{$listItem->client->title}}">
                        <a href="/clients/profile/{{$listItem->client->id}}" class="d-flex justify-content-start align-items-center">
                            <div class="p-2 bg-primary-subtle rounded-circle me-2 d-flex align-items-center justify-content-center">
                                <i class="ti ti-briefcase text-primary fs-3"></i>
                            </div>
                            
                            {{ strlen($listItem->client->title) > 20 ? mb_substr($listItem->client->title, 0, 20) . '...' : $listItem->client->title }}
                        </a>
                    </td>
                    <td>
                        <div class="d-flex align-items-center">
                            <i class="ti ti-circle-filled fs-1 text-primary pe-2"></i> {{ $listItem->client->phone }}
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="ti ti-circle-filled fs-1 text-success pe-2"></i> {{ $listItem->client->email }}
                        </div>
                    </td>
                    <td>
                        <a href="/employees/profile/{{$listItem->employee->id}}" class="d-flex justify-content-start align-items-center">
                            <div class="p-2 bg-primary-subtle rounded-circle me-2 d-flex align-items-center justify-content-center">
                                <i class="ti ti-user text-primary fs-3"></i>
                            </div>
                            {{ $listItem->employee->first_name }} {{ $listItem->employee->last_name }}
                        </a>
                    </td>
                    <td>{{ $listItem->tax }}</td>
                    <td>{{ $listItem->discount }}</td>
                    <td>{{ $listItem->in_total }}</td>
                    <td style="width: 50px;" class="text-end">
                        <a class="btn bg-primary-subtle text-primary me-2 px-2" href="/estimates/profile/{{ $listItem->id }}" data-bs-toggle="tooltip" title="Edit">
                            <i class="ti ti-file-time fs-6"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
