<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Product;
use App\Category;
use App\Sub_category;

class SearchController extends Controller
{
    public function live_search(Request $request)
    {
    	if($request->ajax()){
    		$output = '';
    		$query = $request->get('query');
    		// dd($query);
    		if($query != ''){
    			$data = DB::table('products')
    					->where('name', 'like', '%'.$query.'%')
    					->orWhere('category_id', 'like', '%'.$query.'%')
    					->orderBy('id', 'desc')
    					->get();
    		} else {
    			$data = DB::table('products')
    					->orderBy('id', 'desc')
    					->get();
    		}
    		// dd($data);

    		$total_row = $data->count();
    		if(!empty($total_row)){
    			foreach ($data as $row) {
    				$output .= '
    					<tr>
    						<td>'.$row->name.'</td>
    						<td>'.$row->buying_price.'</td>
    						<td>'.$row->selling_price.'</td>
    						<td>'.$row->category_id.'</td>
    						<td>'.$row->sub_category_id.'</td>
    					</tr>
    				';
    			}
    		} else {
    			$output .= '
    				<tr>
    					<td align="center" colspan="5">No Data Found</td>
    				</tr>
    			';
    		}

    		$data = array(
    			'table_data' => $output,
    			'total_products' => $total_row
    		);
    		echo json_encode($data);
    	}
    }



    public function search_product(Request $request)
    {
    	$search = $request->search;
    	$data['products'] = Product::where('name', $search)->first();
    	// dd($data['products']);
    	if($data['products']){
    		$data['products'] = Product::where('name', $search)->first();
    		$categories = Category::all();
        	$sub_categories = Sub_category::all();
    		return view('search', compact('data', 'categories', 'sub_categories'));
    	} else {
    		return redirect()->back()->with('error', 'No product match');
    	}
    }


    public function get_product(Request $request)
    {
    	$search = $request->search;
    	$productData = DB::table('products')
    					->where('name', 'LIKE', '%'.$search.'%')
    					->get();
    	$html = '';
    	$html .= '<div><ul>';
    	if($productData){
    		foreach($productData as $v){
    			$html .= '<li>'.$v->name.'</li>';
    		}
    		$html .= '</ul></div>';
    		return response()->json($html);
    	}
    }



}
