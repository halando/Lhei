<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getDrinks(){
        $drinks=  Drink::all();
        if (is_null($drinks)) {
            return $this->sendError("Hiba a lekérdezésben");
        }
        return $this->sendResponse(DrinkResource::collection($drinks), "Betöltve");
    }
    
    public function getDrinkByNameReq(Request $request){
        $name = $request->all();
        $name = $name["name"];
        $drink=  Drink::with("type","package")->where("drink",$name)->first();
        
        if (is_null($drink)) {
            return $this->sendError("Nincs ilyen ital");
        }
        return $this->sendResponse(DrinkResource::make($drink), "Betöltve");
    }
    public function addDrink(DrinkChecker $request){
        $request->validated();
        $input = $request->all();
        
        $drink = new Drink;
        $drink->drink=$input["drink"];
        $drink->amount=$input["amount"];
        $drink->type_id= (new TypeController)->getTypeIdByName($input["type"]);
        $drink->package_id= (new PackageController)->getPackageIdByName($input["package"]);
        if (is_null($drink)) {
            return $this->sendError("hiba a bejövő paraméterekben");
        }
        $drink->save();
        return $this->sendResponse(DrinkResource::make($drink), "Mentve");
    }
    
    
    public function modifyDrink(DrinkChecker $request){
        $request->validated();
        $id = $request->get("id");
        $drink = Drink::find($id);
        $drink->drink = $request->get("drink");
        $drink->amount = $request->get("amount");
        $drink->type_id= (new TypeController)->getTypeIdByName($request->get("type"));
        $drink->package_id= (new PackageController)->getPackageIdByName($request->get("package"));
        $drink->save();
        if (is_null($drink)) {
            return $this->sendError("hiba a bejövő paraméterekben","Nincs ilyen ital");
        }
        return $this->sendResponse(DrinkResource::make($drink), "Módosítva");
    }
    
    public function destroyDrink(Request $request){
        
        $drink = Drink::find($request->get("id"));
        if (is_null($drink)) {
            return $this->sendError("hiba a bejövő paraméterekben","Nincs ilyen ital");
        }else {
            Drink::destroy($drink->id);
            return $this->sendResponse(DrinkResource::make($drink), "Törölve");
        }
    }
}
