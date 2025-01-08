<?php

namespace App\Http\Controllers;

use App\Models\Job;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function authRegiter(Request $request)
    {

        // dd($request->all());
        // die;

        $inserted =  User::create([
            "name" => $request->name,
            "email" => $request->email,
            "password" => $request->password,
        ]);
        if ($inserted) {
            return response()->json([
                "status" => true,
                'message' => 'Registration successfully'
            ], 200);
        } else {
            return response()->json([
                "status" => false,
                'message' => 'registration failed'
            ], 400);
        }
    }

    public function authLogin(Request $request)
    {

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            if (Auth::user()->role == 'admin' || Auth::user()->role == 'employer') {
                return response()->json([
                    'status' => true,
                    'message' => 'Login successful',
                    'redirect_url' => route('dashboard'),
                ], 200);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Login successful',
                    'redirect_url' => route('home'),
                ], 200);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Login failed',
                'redirect_url' => route('login'), // Provide a URL to redirect to
            ], 200);
        }
    }

    public function authLogout()
    {
        Auth::logout();
        return redirect()->route("home");
    }

    public function userEdit(Request $request)
    {
        $id = $request->id;
        $user = User::find($id);
        if ($user) {
            return response()->json([
                "status" => true,
                'message' => 'User found',
                'data' => $user,
            ]);
        } else {
            return response()->json([
                "status" => false,
                'message' => 'User not found',
            ]);
        }
    }

    public function userUpdate(Request $request)
    {
        $id = $request->id;
        // $name = $request->email;
        // print_r($name);
        // die;
        $user = User::where("id", $id)->update([
            "name" => $request->name,
            "email" => $request->email,
        ]);
        if ($user) {
            return response()->json([
                "status" => true,
                'message' => 'User updated successfully',
            ]);
        } else {
            return response()->json([
                "status" => false,
                'message' => 'Updation failde',
            ]);
        }
    }


    public function userDelete(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $delete = User::where("id", $id)->delete();
            if ($delete) {
                return response()->json([
                    "status" => true,
                    'message' => 'User deleted successfully',
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    'message' => 'failde',
                ]);
            }
        } else {
            return response()->json([
                "status" => false,
                'message' => 'User not found',
            ]);
        }
    }


    public function allJobsList()
    {
        $allJobs = DB::table("jobs")->join("users", "users.id", "=", "jobs.posted_by")->get(array('jobs.*', 'users.name as posted_by'));
        // print_r($allJobs);
        // die;
        return view("authentication.alljobs", [
            "jobs" => $allJobs
        ]);
    }

    public function allApplicationsList()
    {
        $allapplications = DB::table("applications")
            ->Join('jobs', "applications.job_id", '=', "jobs.id")
            ->Join("users",  "applications.user_id", '=', "users.id")
            ->join("users as posters", "jobs.posted_by", '=', "posters.id")
            ->select(
                'jobs.title',
                'applications.status',
                'users.name',
                'posters.name as posted_by',
                "applications.id as applicationId",
                DB::raw("DATE_FORMAT(jobs.created_at, '%d-%m-%y') as formatted_date")
            )
            ->get();
        // echo "<pre>";
        // print_r($allapplications);
        // die;
        return view("authentication.allapplicationslistAdmin", [
            "applications" => $allapplications
        ]);
    }
}
