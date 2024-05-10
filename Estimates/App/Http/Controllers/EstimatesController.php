<?php

namespace Modules\Estimates\App\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Estimates\App\Models\Estimate;
use Modules\Clients\App\Models\Client;
use Modules\Employees\App\Models\Employee;
use Modules\Estimates\App\Models\EstimateItem;
use Illuminate\Support\Facades\Validator;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class EstimatesController extends Controller
{
    public $_aimx = [
        'name' => 'Estimates',
        'title' => 'Estimates',
        'description' => 'estimate list',
        'icon' => 'ti ti-file-time',
        'color' => 'purple',
        'module' => 'estimates',
        'code' => 'estimates', 
        'urlBase' => 'estimates',
        'jsFiles' => ['/assets/js/aim-list.js'],
        'cssFiles' => [],
    ];

    public $_listWithRelations = ['employee'];
    public $_listPerPageDefault = 30;
    public $_listSortModeDefault = "asc";
    public function _initListModel()
    {
        $this->_listModel = new Estimate;
    }

    public function list(Request $request)
    {
        $auth = $this->auth($this->_aimx['module'].".access_".$this->_aimx['code']);
        if (!$auth['ok']) { return $auth['x']; }
        $this->_buildData($request);
        $this->_listOnRun();

        $statusTypes = Estimate::statusTypes();
        return view($this->_aimx['module'].'::'.$this->_aimx['code'].'_list', array_merge($this->page, [
            'statusTypes' => $statusTypes,
        ]));
    }

    public function profile(Request $request, $id, $tab = "overview")
    {
        $auth = $this->auth("estimates.access_estimates", function() use ($id) {
            return Estimate::find($id);
        });
        if (!$auth['ok']) { return $auth['x']; }
        $estimate = $auth['item'];

        $tabs = ["overview", "items", "import"];
        $itemArray = [];
        $tab = in_array($tab, $tabs) ? $tab : 'overview';
        $statusTypes = Estimate::statusTypes();
        $clients = Client::all();
        $employees = Employee::all();

        $estimateItems = EstimateItem::where('estimate_id', $id)->get();
        $totalCost = EstimateItem::where('estimate_id', $id)->sum('total_cost');

        return view('estimates::estimates_profile', [
            'statusTypes' => $statusTypes,
            'total_sum' => $totalCost,
            'estimate' => $estimate,
            'clients' => $clients,
            'employees' => $employees,
            'estimateItems' => $estimateItems,
            'aimx' => $this->_aimx,
            'tab' => $tab,
            'itemArray' => $itemArray
        ]);
    }

    public function onShowFilters() {
        $filters = Session::get($this->_aimx['module'].'_'.$this->_aimx['code'].'_filters', []);

        $filterClients = DB::table('estimates')
            ->select('clients.id', 'clients.title')
            ->join('clients', 'estimates.client_id', '=', 'clients.id')
            ->distinct()
            ->get();
            //slow- 2.5ms par šito query!!!
        
        $filterEmployees = DB::table('estimates')
            ->select('employees.id', 'employees.first_name', 'employees.last_name')
            ->join('employees', 'estimates.employee_id', '=', 'employees.id')
            ->distinct()
            ->get();
            //not that slow 540us

        $filterStatuses = DB::table('estimates')->select('status')->distinct()->get();
        // $filterClients = DB::table('clients')->select('id', 'title')->get();
        // $filterEmployees = DB::table('employees')->select('id', 'first_name', 'last_name')->get();
        
        $view = view($this->_aimx['module'].'::'.$this->_aimx['code'].'_list_filters', [
            'filterOptions' => [
                'statuses' => $filterStatuses,
                'clients' => $filterClients,
                'employees' => $filterEmployees,
                
            ],
            "filters" => $filters
        ])->render();

        return [
            '#aim-filter-body' => $view
        ];
    }


    public function onStoreEstimate (Request $request)
    {
        $auth = $this->auth("estimates.manage_estimates");
        if (!$auth['ok']) { return $auth['x']; }

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'tax' => 'numeric|min:0',
            'discount' => 'numeric|min:0',
            'in_total' => 'numeric|min:0',
        ]);

        if ($validator->fails()) {
            return $this->toast("Validation Error");
        }
        
        $estimate = new Estimate();
        $estimate->name = $request->input('title');
        $estimate->status = $request->input('status');
        $estimate->employee_id = $request->input('employee_id');
        $estimate->client_id = $request->input('client_id');
        $estimate->position_count = '1';
        $estimate->tax = $request->input('tax');
        $estimate->discount = $request->input('discount');
        $estimate->in_total = $request->input('in_total');
        $estimate->save();

        $estimates = Estimate::all();
        $statusTypes = Estimate::statusTypes();
        
        return $this->redirect('/estimates');
    }
  
    public function onSave(Request $request, $tab = "overview")
    {
        $id = $request->input('estimateId');
        $auth = $this->auth("estimates.manage_estimates", function() use ($id) { return Estimate::find($id); });
        if (!$auth['ok']) { return $auth['x']; }
        $estimate = $auth['item'];

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'status' => 'required|string|max:255',
            'tax' => 'required|numeric|min:0',
            'discount' => 'required|numeric|min:0',
            'in_total' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return $this->toast("Validation Error");
        }

        $estimate->name = $request->input('title');
        $estimate->status = $request->input('status');
        $estimate->tax = $request->input('tax');
        $estimate->employee_id = $request->input('employee_id');
        $estimate->client_id = $request->input('client_id');
        $estimate->discount = $request->input('discount');
        $estimate->in_total = $request->input('in_total');
        $estimate->save();
    
        $estimates = Estimate::find($id);
        $statusTypes = Estimate::statusTypes();
        $clients = Client::all();
        $employees = Employee::all();
        $estimateItems = EstimateItem::where('estimate_id', $id)->get();
        $totalCost = EstimateItem::where('estimate_id', $id)->sum('total_cost');
        
        $settingsView = view('estimates::estimates_profile', [
            'clients' => $clients,
            'employees' => $employees,
            'statusTypes' => $statusTypes,
            'total_sum' => $totalCost,
            'estimate' => $estimates,
            'estimateItems' => $estimateItems,
            'aimx' => $this->_aimx,
            'tab' => $tab
        ])->render();
    
        return [
            "#settings-content" => $settingsView,
            "#aim-toast" => $this->toast("Estimate Updated!")["#aim-toast"],
        ];
    }

    public function onOpenAddEstimateModal(Request $request) 
    {
        $auth = $this->auth("estimates.manage_estimates");
        if (!$auth['ok']) { return $auth['x']; }

        $statusTypes = Estimate::statusTypes();
        $clients = Client::all();
        $employees = Employee::all();
        
        $view = view('estimates::estimates_create_modal',[
            'clients' => $clients,
            'employees' => $employees,
            'statusTypes' => $statusTypes,
        ])->render();

        return [
            '#aim-modal' => $view,
        ];
    }

    public function onOpenAddItemModal(Request $request) 
    {
        $auth = $this->auth("estimates.manage_estimates");
        if (!$auth['ok']) { return $auth['x']; }
        
        $view = view('estimates::estimate_item_create_modal')->render();
        return ['#aim-modal' => $view];
    }

    public function onOpenItemEditModal(Request $request) 
    {
        $id = $request->input('id');
        $auth = $this->auth("estimates.manage_estimates", function() use ($id) { return EstimateItem::find($id); });
        if (!$auth['ok']) { return $auth['x']; }
        $estimate = $auth['item'];
        
        $view = view('estimates::estimates_item_edit_modal',['estimate' => $estimate])->render();
        return ['#aim-modal' => $view];
    }

    public function onStoreItem(Request $request, $tab = "items")
    {
        $auth = $this->auth("estimates.manage_estimates");
        if (!$auth['ok']) { return $auth['x']; }

        $estimateId = $request->args[0] ?? null;

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'unit' => 'required|string|max:255',
            'unit_value' => 'required|numeric|min:0',
            'work_q' => 'required|numeric|min:0',
            'work_cost' => 'required|numeric|min:0',
            'resource_cost' => 'required|numeric|min:0',
            'mech_cost' => 'required|numeric|min:0',
            'other_cost' => 'required|numeric|min:0',
            'total_cost' => 'required|numeric|min:0',
        ]);

        if ($validator->fails()) {
            return $this->toast("Validation Error");
        }
        

        $item = new EstimateItem();
        $item->title = $request->input('title');
        $item->unit_id = $request->input('unit');
        $item->unit_value = $request->input('unit_value');
        $item->work_quantity = $request->input('work_q');
        $item->work_cost = $request->input('work_cost');
        $item->resource_cost = $request->input('resource_cost');
        $item->mechanical_cost = $request->input('mech_cost');
        $item->other_cost = $request->input('other_cost');
        $item->total_cost = $request->input('total_cost');
        $item->estimate_id = $estimateId;
        $item->save();

        $estimate = Estimate::find($estimateId);
        $estimateItems = EstimateItem::where('estimate_id', $estimateId)->get();
        $totalCost = EstimateItem::where('estimate_id', $estimateId)->sum('total_cost');

        $View = view('estimates::estimates_profile_items', [
            'estimate' => $estimate,
            'estimateItems' => $estimateItems,
            'total_sum' => $totalCost,
            'aimx' => $this->_aimx,
            'tab' => $tab
        ])->render();
    
        return [
            "#profile-content" => $View,
            "#aim-toast" => $this->toast("Item Created!")["#aim-toast"],
            '#aim-script' => "<script>$(document).ready(function() { $('#estimates_create_item_modal').modal('hide'); });</script>"
        ];
    }

    public function onSaveItem(Request $request, $tab = "items")
    {
        $estimateId = $request->args[0] ?? null;
        $auth = $this->auth("estimates.manage_estimates");
        if (!$auth['ok']) { return $auth['x']; }

        $input = $request->input();
        $EstimateItemId = $request->input('ItemId');
        $Item = EstimateItem::find($EstimateItemId);

        $Item->title = $input['title'];
        $Item->unit_id = $input['unit'];
        $Item->unit_value = $input['unit_value'];
        $Item->work_quantity = $input['work_q'];
        $Item->work_cost = $input['work_cost'];
        $Item->resource_cost = $input['resource_cost'];
        $Item->mechanical_cost = $input['mech_cost'];
        $Item->other_cost = $input['other_cost'];
        $Item->total_cost = $input['total_cost'];
        $Item->estimate_id = $input['estimate_id'];
        $Item->save();

        $estimate = Estimate::find($estimateId);
        $estimateItems = EstimateItem::where('estimate_id', $estimateId)->get();
        $totalCost = EstimateItem::where('estimate_id', $estimateId)->sum('total_cost');

        $View = view('estimates::estimates_profile_items', [
            'estimate' => $estimate,
            'estimateItems' => $estimateItems,
            'total_sum' => $totalCost,
            'aimx' => $this->_aimx,
            'tab' => $tab
        ])->render();

        return [
            "#profile-content" => $View,
            "#aim-toast" => $this->toast("Item Updated!")["#aim-toast"],
            '#aim-script' => "<script>$(document).ready(function() { $('#estimates_item_edit_modal').modal('hide'); });</script>"
        ];
    }

    public function onImportData(Request $request, $tab="items")
    {
        $auth = $this->auth("estimates.manage_estimates");
        if (!$auth['ok']) { return $auth['x']; }

        $estimateId = $request->args[0] ?? null;

        $request->validate([
            'file' => 'required|mimes:xlsx,xls',
            'title' => 'required|string|size:1',
            'unit' => 'required|string|size:1',
            'unit_value' => 'required|string|size:1',
            'row_range' => ['required', 'string', function ($attribute, $value, $fail) {
                if (!preg_match('/^\d+-\d+$/', $value)) {
                    $fail('The ' . $attribute . ' must be in the format "number-number".');
                }
            }],
        ]);

        
        $file = $request->file('file');
        
        $titleColumn = strtoupper($request->input('title'));
        $unitColumn = strtoupper($request->input('unit'));
        $unitValueColumn = strtoupper($request->input('unit_value'));
        $rowRange = $request->input('row_range');

        $spreadsheet = IOFactory::load($file);

        list($startRow, $endRow) = explode('-', $rowRange);
        $startRow = (int)$startRow;
        $endRow = (int)$endRow;

        $sheet = $spreadsheet->getActiveSheet();

        $estimateItems = [];
        $count = 1;
        for ($row = $startRow; $row <= $endRow; $row++) {
            $title = $sheet->getCell($titleColumn . $row)->getValue() ?? '---';
            $unit = $sheet->getCell($unitColumn . $row)->getValue() ?? '---';
            $unitValue = $sheet->getCell($unitValueColumn . $row)->getValue() ?? '0';

            if ($title === '---' && $unit === '---' && $unitValue === '0') {
                continue;
            }
        
            $estimateItem = new \stdClass();
            $estimateItem->id = (int) $count;
            $estimateItem->title = (string) $title;
            $estimateItem->unit_id = (string) $unit;
            $estimateItem->unit_value = (double) $unitValue;
        
            $estimateItems[] = $estimateItem;
            $count++;
        }

        $estimate = Estimate::find($estimateId);
        $estimateItem = EstimateItem::where('estimate_id', $estimateId)->get();
        $totalCost = EstimateItem::where('estimate_id', $estimateId)->sum('total_cost');

        $view = view('estimates::estimates_profile_import', [
            'estimate' => $estimate,
            'estimateItems' => $estimateItem,
            'itemArray' => $estimateItems,
            'total_sum' => $totalCost,
            'aimx' => $this->_aimx,
            'tab' => $tab
        ])->render();

        return [
            "#profile-content" => $view,
            "#aim-toast" => $this->toast("File Uploaded!")["#aim-toast"],
            '#aim-script' => "<script>onShowList();</script>"
        ];
    }

    public function onManageImportList(Request $request, $tab = "items") 
    {
        $auth = $this->auth("estimates.manage_estimates");
        if (!$auth['ok']) { return $auth['x']; }

        $estimateId = $request->args[0] ?? null;

        $itemArray = $request->input('items');

        $action = $request->input('action');
        if ($action == 'save') {
            foreach ($itemArray as $item) {
                $estimateItem = new EstimateItem();
                $estimateItem->title = $item['title'];
                $estimateItem->unit_id = $item['unit_id'];
                $estimateItem->unit_value = $item['unit_value'];
                $estimateItem->estimate_id = $estimateId;
                $estimateItem->save();
            }
            $toast="Items Saved";
            $itemArray=[];
        } else {
            $itemArray=[];
            $toast="List Removed";
        }
        
        $estimate = Estimate::find($estimateId);
        $estimateItems = EstimateItem::where('estimate_id', $estimateId)->get();
        $totalCost = EstimateItem::where('estimate_id', $estimateId)->sum('total_cost');

        $view = view('estimates::estimates_profile_import', [
            'estimate' => $estimate,
            'estimateItems' => $estimateItems,
            'total_sum' => $totalCost,
            'aimx' => $this->_aimx,
            'tab' => $tab,
            'itemArray' => $itemArray
        ])->render();

        return [
            "#profile-content" => $view,
            "#aim-toast" => $this->toast($toast)["#aim-toast"],
            '#aim-script' => "<script>onHideList();</script>"
        ];
    }


    public function onDelete(Request $request)
    {
        $auth = $this->auth("estimates.manage_estimates");
        if (!$auth['ok']) { return $auth['x']; }

        $id = $request->input('id');
        $estimate = Estimate::find($id);

        if (!$estimate) {
            return $this->toast("Estimate Not Found!");
        }

        $estimate->delete();

        return $this->redirect('/estimates');
    }

    public function onDeleteItem(Request $request, $tab="items")
    {
        $auth = $this->auth("estimates.manage_estimates");
        if (!$auth['ok']) { return $auth['x']; }

        $estimateId = $request->args[0] ?? null;
        
        $id = $request->input('id');
        $estimateItem = EstimateItem::find($id);

        if (!$estimateItem) {
            return $this->toast("Item Not Found!");
        }

        $estimateItem->delete();

        $estimate = Estimate::find($estimateId);
        $estimateItems = EstimateItem::where('estimate_id', $estimateId)->get();
        $totalCost = EstimateItem::where('estimate_id', $estimateId)->sum('total_cost');

        $View = view('estimates::estimates_profile_items', [
            'estimate' => $estimate,
            'estimateItems' => $estimateItems,
            'total_sum' => $totalCost,
            'aimx' => $this->_aimx,
            'tab' => $tab
        ])->render();

        return [
            "#items-content" => $View,
            "#aim-toast" => $this->toast("Item Deleted!")["#aim-toast"],
        ];
    }
}
