<?php
namespace App\Http\Controllers;

use App\Models\RestesProduits;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use PDF;
class CustomAuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function customLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/')
                        ->withSuccess('Signed in');
        }

        return redirect("login")->withSuccess('Login details are not valid');
    }

    public function registration()
    {
        return view('auth.registration');
    }

    public function customRegistration(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $data = $request->all();
        $check = $this->create($data);

        return redirect("/")->withSuccess('You have signed-in');
    }

    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }

    public function dashboard()
    {
        if(Auth::check()){
            $restes = RestesProduits::orderBy('id','desc')->get();
            return view('dashboard', compact('restes'));
        }

        return redirect("login")->withSuccess('You are not allowed to access');
    }

    public function signOut() {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }

    public function exportpdf(Request $request){
        $restes = RestesProduits::orderBy('id','desc')->get();
//dd($sorties);
        $pdf = PDF::loadView('export', compact('restes'));
    //   $pdf->setPaper('A4', 'landscape');
         $pdf->setPaper('A4', 'portrait');
         $date = date('Ymd-His');

          // ##### pagination ###############
          $pdf->output();
          $dom_pdf = $pdf->getDomPDF();
          $canvas = $dom_pdf->get_canvas();
          $footer = $canvas->open_object();
          $w = $canvas->get_width();
          $h = $canvas->get_height();
          $canvas->page_text($w-92,$h-52, "Page {PAGE_NUM} sur {PAGE_COUNT}", null, 8, array(0, 0, 0));
          $canvas->close_object();
          $canvas->add_object($footer,"all");
          // ##### end pagination ###############


         $name = "export-reste"."-". $date .".pdf";
         return $pdf->download($name);
    }
}
