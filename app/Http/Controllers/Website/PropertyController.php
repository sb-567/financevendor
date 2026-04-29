<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PropertyController extends Controller
{
    protected $apartment_type = [
        '1' => '1BHK',
        '2' => '2BHK',
        '3' => '3BHK',
        '4' => '4BHK',
        '5' => '5BHK',
    ];
    protected $property_type = [
        '1' => 'Rent',
        '2' => 'Sale',
        '3' => 'Lease',
    ];


    public function getproperties(Request $request)
    {
        $data['title'] = 'Properties List';

        // echo "<pre>";
        // print_r($request->all());
        // die;

        $query = DB::table('tbl_properties as p')
            ->leftJoin('tbl_vendors as v', 'v.id', '=', 'p.vendor_id')
            ->select(
                'p.*',
                'v.name as vendor_name',
                'v.phone as vendor_mobile'
            );

        // ✅ Price Type (multiple checkbox)
        if ($request->filled('price_type')) {
            $query->whereIn('p.price_type', $request->price_type);
        }

        // ✅ Apartment Type (multiple checkbox)
        if ($request->filled('apartment_type')) {
            $query->whereIn('p.apartment_type', $request->apartment_type);
        }

        // ✅ Parking (radio)
        if ($request->filled('parking_avalible')) {
            $query->where('p.parking_availability', $request->parking_avalible);
        }

        // ✅ Pagination + keep filters in URL
        $properties = $query->paginate(9)->withQueryString();

        // send to view
        $data['propertiesdata'] = $properties;

        return view('website.properties', $data);
    }
    
     public function getpropertydetail(Request $request)
    {
        $data['title'] = 'Property Detail';

        $data['property'] = DB::table('tbl_properties as p')
            ->leftJoin('tbl_vendors as v', 'v.id', '=', 'p.vendor_id')
            ->select('p.*', 'v.name as vendor_name', 'v.phone as vendor_mobile')
            ->where('p.property_slug', $request->slug)
            ->first();
        // echo "<pre>";
        // print_r($this->apartment_type);
        // die;
        $data['apartmentTypes'] = $this->apartment_type;
        $data['propertyTypes'] = $this->property_type;
        return view('website.propertydetail', $data);
    }
    
}
