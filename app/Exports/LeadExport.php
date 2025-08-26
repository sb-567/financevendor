<?php

namespace App\Exports;

use App\Models\Lead;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Illuminate\Support\Facades\DB;


class LeadExport implements FromCollection, WithHeadings
{   

    protected $filters;

    public function __construct($filters = [])
    {
        $this->filters = $filters;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    /**
     * Return the collection of data to export
     */
    public function collection()
    {   
        return DB::table('tbl_leads')->select('tbl_vendors.name as vendor_name', 'tbl_leads.name', 'tbl_leads.email', 'tbl_leads.phone', 'tbl_leads.created_at')
            ->leftJoin('tbl_vendors', 'tbl_vendors.id', '=', 'tbl_leads.vendor_id')
            ->where(function ($query) {
                if (!empty($this->filters['vendor_id'])) {
                    $query->where('tbl_leads.vendor_id', $this->filters['vendor_id']);
                }
            })
            ->get();
        // return Lead::select('id', 'name', 'email', 'created_at')->get();
    }

    /**
     * Add custom column headings
     */
    public function headings(): array
    {
        return ["Vendor Name", "Name", "Email", "Phone", "Created At"];
    }
}
