<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    
    public function getCurrencyByName($name) {
        $curr = \DB::table('currency')->where('name', $name)->first();
        return $curr->rate;
    }
    
    public function updateGroupPrice($group_id) {
        $material_group = \DB::table('material_group')->where('group_id',$group_id)->get();
        
        $total_cost = 0;
        foreach ($material_group as $mg):
            $c_amount = $mg->price*$mg->weight;
            $total_cost+=$c_amount;
        endforeach;
        
        $sum_weight = \DB::table('material_group')->where('group_id',$group_id)->sum('weight');
        if($sum_weight){
            \DB::table('group_category')->where('id', $group_id)->update(['price' => $total_cost/$sum_weight]);
        }
        
        return true;
    }
    
    public function updateAllGroupPrice($material_id)
    {
        $material_group = \DB::table('material_group')->where('material_id',$material_id)->get();
        
        foreach($material_group as $mg):
            $this->updateGroupPrice($mg->group_id);
        endforeach;
        
        return true;
    }
    
    public function getLastMaterialPrice($material_id)
    {
        return \DB::table('material_price')->where('material_id', $material_id)->orderBy('date','DESC')->first();
    }
}
