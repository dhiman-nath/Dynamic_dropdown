<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Country;
use App\City;
use App\Area;


class CountryController extends Controller
{
    //
    public function index(){

        // Fetch Country
        $countries['data'] = Country::orderby("CountryName","asc")
        			   ->select('id','CountryName')
        			   ->get();

        // Load index view
    	return view('Dropdown.index',compact('countries'));
    }

    public function getCities($countryid=0){

    	// Fetch Employees by Departmentid
        $cities['data'] = City::orderby("CityName","asc")
        			->select('id','CityName')
        			->where('Country_id',$countryid)
        			->get();
  
        return response()->json($cities);
     
    }

    public function getAreas($cityid=0){

    	// Fetch Employees by Departmentid
        $areas['data'] = Area::orderby("AreaName","asc")
        			->select('id','AreaName')
        			->where('city_id',$cityid)
        			->get();
                   
  
        return response()->json($areas);
     
    }
}
