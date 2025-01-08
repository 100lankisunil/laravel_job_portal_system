<?php

namespace App\Http\Controllers;

use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmployerController extends Controller
{
    public function postJob(Request $request)
    {
        $id = $request->posted_by;
        if ($id) {
            $jobInsert = [
                'title' => $request->title,
                'description' => $request->description,
                'requirements' => $request->requirements,
                'salary_range' => $request->salary_range,
                'location' => $request->location,
                'posted_by' => $request->posted_by,
            ];
            $job = Job::create($jobInsert);
            if ($job) {
                return response()->json([
                    "status" => true,
                    'message' => 'Job posted successfully'
                ], 200);
            } else {
                return response()->json([
                    "status" => false,
                    'message' => 'Failed to post job'
                ], 400);
            }
        } else {
            return response()->json([
                'message' => 'You are not logged in'
            ], 401);
        }
    }

    public function manageJob()
    {
        $id = Auth::user()->id;
        // print_r($id);
        $jobs = Job::where('posted_by', $id)->get();
        // echo "<pre>";
        // print_r($jobs);
        return view('employer.manage_job', [
            'jobs' => $jobs
        ]);
    }

    public function jobsEdit(Request $request)
    {
        $id = $request->id;

        if ($id) {
            $job = Job::where("id", $id)->get();
            return response()->json([
                'status' => true,
                'message' => "job founds",
                'data' => $job,
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid request'
            ], 400);
        }
        // echo "<pre>";
        // print_r($job);
    }

    public function jobsUpdate(Request $request)
    {
        $id = $request->id;
        $jobs = Job::where("id", $id)->update([
            "title" => $request->title,
            "description" => $request->description,
            "requirements" => $request->requirements,
            "salary_range" => $request->salary_range,
            "location" => $request->location,
        ]);
        if ($jobs) {
            return response()->json([
                "status" => true,
                'message' => 'Updated successfully',
            ]);
        } else {
            return response()->json([
                "status" => false,
                'message' => 'Updation failde',
            ]);
        }
    }

    public function jobsDelete(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $delete = Job::where("id", $id)->delete();
            if ($delete) {
                return response()->json([
                    "status" => true,
                    'message' => 'deleted successfully',
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

    public function allApplicationsList($id)
    {
        $allapplications = DB::table("applications")
            ->Join('jobs', "applications.job_id", '=', "jobs.id")
            ->Join("users",  "applications.user_id", '=', "users.id")
            ->join("users as posters", "jobs.posted_by", '=', "posters.id")
            ->where("jobs.posted_by", $id)
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
        return view("employer.allapplicationslist", [
            "applications" => $allapplications
        ]);
    }

    public function approveApplication(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $updateStatus = DB::table("applications")
                ->where("id", $id)
                ->update([
                    "status" => "approved"
                ]);
            if ($updateStatus) {
                return response()->json([
                    "status" => true,
                    'message' => 'Application approved',
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    'message' => 'Application not approved',
                ]);
            }
        }
    }

    public function rejectApplication(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $updateStatus = DB::table("applications")
                ->where("id", $id)
                ->update([
                    "status" => "rejected"
                ]);
            if ($updateStatus) {
                return response()->json([
                    "status" => true,
                    'message' => 'Application rejected',
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    'message' => 'Application not rejected',
                ]);
            }
        }
    }

    public function pendingApplication(Request $request)
    {
        $id = $request->id;
        if ($id) {
            $updateStatus = DB::table("applications")
                ->where("id", $id)
                ->update([
                    "status" => "pending"
                ]);
            if ($updateStatus) {
                return response()->json([
                    "status" => true,
                    'message' => 'Application pending',
                ]);
            } else {
                return response()->json([
                    "status" => false,
                    'message' => 'Application not pending',
                ]);
            }
        }
    }
}
