<?php

namespace App\Http\Controllers\Install;

use App\Http\Controllers\Controller;
use App\Utilities\Installer;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class InstallController extends Controller
{
    public function __construct()
    {
        if (env('APP_INSTALLED', false) == true) {
            Redirect::to('/')->send();
        }
    }

    public function index()
    {
        $requirements = Installer::checkServerRequirements();
        return view('install.step_1', compact('requirements'));
    }

    public function activation()
    {
        $activation_code = '';

        if (file_exists(public_path() . '\license.txt')) {
            $license = file_get_contents(public_path() . '\license.txt');
            if ($license != '') {
                $activation_code = $license;
            }
        }

        return view('install.activation', compact('activation_code'));
    }

    public function activate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code' => 'required|string|min:8'
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $code = $request->code;
        if ($code != '') {
            return redirect('install/database');
        }
        $msg = 'Unable to activate  your purchase';
        return response()->json($msg);
    }

    public function database()
    {
        return view('install.step_2');
    }

    public function process_install(Request $request)
    {
        $host     = $request->hostname;
        $database = $request->database;
        $port     = $request->port;
        $username = $request->username;
        $password = $request->password;

        if (Installer::createDbTables($host, $port, $database, $username, $password) == false) {
            return redirect()->back()->with("error", "Invalid Database Settings !");
        }

        return redirect('install/create_user');
    }

    public function create_user()
    {
        return view('install.step_3');
    }

    public function store_user(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'     => 'required|string|max:191',
            'email'    => 'required|string|email|max:191|unique:users',
            'password' => 'required|string|min:6',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $name     = $request->name;
        $email    = $request->email;
        $password = Hash::make($request->password);

        Installer::createUser($name, $email, $password);

        return redirect('install/system_settings');
    }

    public function system_settings()
    {
        return view('install.step_4');
    }

    public function final_touch(Request $request)
    {
        Installer::updateSettings($request->all());
        Installer::finalTouches($request->site_title);
        return redirect()->route('settings.update_settings');
    }

    public function deleteFile($file)
    {
        Storage::disk(public_path())->delete($file);
    }
}
