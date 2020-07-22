<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Paste;
use App\Repositories\PasteRepository;

class PasteController extends Controller
{
    protected $pastes;

    public function __construct(PasteRepository $pastes)
    {
        //$this->middleware('auth');
        $this->pastes = $pastes;
    }    
    
    public function index(Request $request)
    {
        return view('pastes.index', [
            'pastes' => $this->pastes->loadLast(),
        ]);
        //'pastes' => $this->pastes->forUser($request->user()),
    }
    
    /*
     * Pagination user pastes
     */
    public function pages(Request $request)
    {
        if(\Auth::user()==null)
           return redirect()->guest('login');
        
        $this->middleware('auth');
        //Route::auth();
        $pastes = null;
        if(\Auth::user()!=null)
            $pastes = $this->pastes->loadUser(\Auth::user());
        return view('pastes.pages', [
            'pastes' => $pastes,
        ]);
        //'pastes' => $this->pastes->forUser($request->user()),
    }
    public function find(Request $request)
    {
        $pastes = $this->pastes->loadFind($request->find);
        return view('pastes.pages', [
            'pastes' => $pastes,
        ]);
        //'pastes' => $this->pastes->forUser($request->user()),
    }    
    
     // Страница пасты
    public function link_view(Request $request, string $link)
    {
        $link = htmlspecialchars($link, ENT_QUOTES);
        //$paste = new Paste();//Paste::where('link',$link);
        $paste = Paste::select(DB::raw('*, TIMESTAMPDIFF(minute, DATE_ADD(created_at, INTERVAL exp_time MINUTE),NOW()) AS date_diff'))
                ->where('link',$link)->first();
        return view('pastes.view', [
            'paste' => $paste,
        ]);
        
    }     
    public function store(Request $request)
    {
        $this->validate($request, [
            'text' => 'required|min:1',
        ]);
        
        $p = new Paste();
        $p->link = $p->GenerateLink();
        $p->name =$request->name;
        $p->text =htmlspecialchars($request->text,ENT_QUOTES);
        if($request->user()!=null)
            $p->user_id =$request->user()->id;
        else
            $p->user_id = 0;
        $p->lang =htmlspecialchars($request->lang,ENT_QUOTES);
        $p->exp_time = $request->exp_time;
        $p->date = date("Y-m-d H:i:s");
        $p->access = $request->access;
        $p->save();

        return redirect('/'.$p->link);
    }

    public function destroy(Request $request, Paste $paste)
    {
        $this->authorize('destroy', $paste);

        $paste->delete();

        return redirect('/pastes');
    }
}
