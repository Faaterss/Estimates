<?php

namespace Modules\Estimates\App\Models;

use App\Classes\AimModel;
use Modules\Clients\App\Models\Client;
use Modules\Contacts\App\Models\Contact;
use Modules\Employees\App\Models\Employee;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Estimates\Database\factories\EstimateFactory;

class Estimate extends Model
{
    use HasFactory, AimModel;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [];

    public static function statusTypes()
    {
        return [
            'draft' => ['title' => 'Draft', 'icon' => 'ti ti-user', 'color' => 'secondary-subtle', 'text-color' => 'muted'],
            'sent' => ['title' => 'Sent', 'icon' => 'ti ti-send', 'color' => 'light', 'text-color' => 'primary'],
            'viewed' => ['title' => 'Viewed', 'icon' => 'ti ti-eye', 'color' => 'light', 'text-color' => 'primary'],
            'partlyPaid' => ['title' => 'Partly paid', 'icon' => 'ti ti-cash-banknote', 'color' => 'success-subtle', 'text-color' => 'success'],
            'paid' => ['title' => 'Paid', 'icon' => 'ti ti-check', 'color' => 'success-subtle', 'text-color' => 'success'],
            'canceled' => ['title' => 'Canceled', 'icon' => 'ti ti-x', 'color' => 'danger-subtle', 'text-color' => 'danger'],
            'partlyRefunded' => ['title' => 'Partly refunded', 'icon' => 'ti ti-receipt-refund', 'color' => 'warning-subtle', 'text-color' => 'warning'],
            'refunded' => ['title' => 'Refunded', 'icon' => 'ti ti-receipt-refund', 'color' => 'warning-subtle', 'text-color' => 'warning'],
        ];
    }
    
    protected static function newFactory(): EstimateFactory
    {
        //return EstimateFactory::new();
    }
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function contact()
    {
        return $this->belongsTo(Contact::class);
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
