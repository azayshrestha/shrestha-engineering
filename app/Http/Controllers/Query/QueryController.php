<?php

namespace App\Http\Controllers\Query;

use App\Http\Controllers\Controller;
use App\Model\Contact\Query;
use Illuminate\Http\Request;

class QueryController extends Controller
{
    public function index(){
        $queries = Query::paginate(20);
        return view('backend.queries.index', compact('queries'));
    }

    public function destroy($id)
    {
        $query = Query::findOrFail($id);
        if($query->delete())
        {
            session()->flash('success_msg','Mail Deleted Successfully');
            return redirect()->action('Query\QueryController@index');
        }else{
            session()->flash('error_msg','Oops! Error Occured.');
            return redirect()->action('Query\QueryController@index');
        }
    }
}
