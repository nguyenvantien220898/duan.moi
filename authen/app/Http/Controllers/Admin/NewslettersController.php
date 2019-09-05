<?php
namespace App\Http\Controllers\Admin;
use App\Model\Admin\NewslettersModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
class NewslettersController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware("auth:admin");
    }
    public function index() {
        $items = DB::table('newsletters')->paginate(5);
        $data = array();
        $data['newsletters'] = $items ;
        $data['total'] = $items->total();
        return view('admin.content.newsletters.index',$data);
    }
    public function create() {
        $data = array();
        return view('admin.content.newsletters.submit',$data);
    }
    public function store(Request $request) {
        $validatedData = $request->validate([
            'email' => 'required',
        ]);
        $input = $request->all();
        $item = new NewslettersModel();
        $item->email = $input['email'];
        $item->save();
        return redirect('/admin/newsletters');
    }
    public function edit($id) {
        $item = NewslettersModel::find($id);
        $data = array();
        $data['newletter'] = $item;
        return view ('admin.content.newsletters.edit',$data);
    }
    public function update(Request $request,$id) {
        $validatedData = $request->validate([
            'email' => 'required',
        ]);
        $input = $request->all();
        $item = NewslettersModel::find($id);
        $item->email = $input['email'];
        $item->save();
        return redirect('/admin/newsletters');
    }
    public function delete($id) {
        $item = NewslettersModel::find($id);
        $data = array();
        $data['newletter'] = $item;
        return view ('admin.content.newsletters.delete',$data);
    }
    public function destroy($id) {
        $item = NewslettersModel::find($id);
        $item->delete();
        return redirect('/admin/newsletters');
    }
}