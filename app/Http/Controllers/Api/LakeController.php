<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function getLake(){
        $users=  Lake::all();
        if (is_null($lakes)) {
            return $this->sendError("Hiba a lekérdezésben");
        }
        return $this->sendResponse(LakeResource::collection($lakes), "Betöltve");
    }
    
    public function getLakeByNameReq(Request $request){
        $name = $request->all();
        $name = $name["name"];
        $lakes=  Lake::with("type","package")->where("lake",$name)->first();
        
        if (is_null($lake)) {
            return $this->sendError("Nincs ilyen felhasználó");
        }
        return $this->sendResponse(LakeResource::make($lake), "Betöltve");
    }
    public function addLake(LakeChecker $request){
        $request->validated();
        $input = $request->all();
        
        $users = new Lake;
        $users->username=$input["username"];
        $users->fullname=$input["fullname"];
        $users->email=$input["email"];
        $users->tagsbegin=$input["tagsbegin"];
        $users->permission=$input["permission"];
        if (is_null($users)) {
            return $this->sendError("hiba a bejövő paraméterekben");
        }
        $lake->save();
        return $this->sendResponse(LakeResource::make($users), "Mentve");
    }
    
    
    public function modifyLake(LakeChecker $request){
        $request->validated();
        $id = $request->get("id");
        $lake = Lake::find($id);
        $lake->username = $request->get("username");
        $lake->fullname = $request->get("fullname");
        $users->email=$input["email"];
        $users->tagsbegin=$input["tagsbegin"];
        $users->permission=$input["permission"];
        $lake->save();
        if (is_null($lake)) {
            return $this->sendError("hiba a bejövő paraméterekben","Nincs ilyen ital");
        }
        return $this->sendResponse(LakeResource::make($lake), "Módosítva");
    }
    
    public function destroyLake(Request $request){
        
        $lake = Lake::find($request->get("id"));
        if (is_null($lake)) {
            return $this->sendError("hiba a bejövő paraméterekben","Nincs ilyen ital");
        }else {
            Lake::destroy($lake->id);
            return $this->sendResponse(LakeResource::make($lake), "Törölve");
        }
    }
}
