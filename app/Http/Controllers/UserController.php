<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function findJobs()
    {
        // $allJobs = DB::table("jobs")
        //     ->join("users", "users.id", "=", "jobs.posted_by")
        //     ->select(
        //         'jobs.*',
        //         'users.name as posted_by',
        //         DB::raw("DATE_FORMAT(jobs.created_at, '%d-%m-%y') as formatted_date")
        //     )
        //     ->get();

        $totaljobs = DB::table("jobs")->count();

        $allJobs = DB::table('jobs')
            ->leftJoin('users', 'users.id', '=', 'jobs.posted_by')
            ->leftJoin('applications', 'applications.job_id', '=', 'jobs.id')
            ->select(
                'jobs.id',
                'jobs.title',
                'jobs.location', // Add location if it's a column
                'jobs.salary_range', // Add salary range if it's a column
                'users.name as posted_by',
                DB::raw("DATE_FORMAT(jobs.created_at, '%d-%m-%y') as formatted_date"),
                DB::raw("COUNT(applications.id) as application_count")
            )
            ->groupBy(
                'jobs.id',
                'jobs.title',
                'jobs.location',
                'jobs.salary_range',
                'users.name',
                'jobs.created_at',
                'applications.job_id'
            )
            ->get();


        // echo "<pre>";
        // print_r($allJobs);
        // die;

        return view('jobseeker.findjobs', [
            "jobs" => $allJobs,
            "totaljobs" => $totaljobs,
        ]);
    }

    public function viewJobPage($id)
    {

        if ($id) {
            $job = DB::table("jobs")
                ->join("users", "users.id", "=", "jobs.posted_by")
                ->select(
                    'jobs.*',
                    'users.name as posted_by',
                    "users.email as email",
                    "users.id as user_id",
                    DB::raw("DATE_FORMAT(jobs.created_at, '%d-%m-%y') as formatted_date")
                )->where("jobs.id", $id)
                ->get();
            // print_r($job);
            // die;
            return view('jobseeker.viewjob', [
                "job" => $job,
            ]);
        }
    }

    public function uploadResume(Request $request)
    {
        $resume = $request->file('resume');
        if ($resume) {
            $userId = $request->userId;
            $jobId = $request->jobId;
            $originalFilename = time() . "_" . $resume->getClientOriginalName();
            $resumePath = $resume->storeAs('resumes', $originalFilename, 'public');
            $insert = DB::table('applications')->insert([
                'job_id' => $jobId,
                'user_id' => $userId,
                'resume_path' => $resumePath,
                'status' => 'pending',
            ]);
            if ($insert) {
                return response()->json([
                    'status' => true,
                    'message' => 'Resume uploaded successfully',
                    'path' => $resumePath
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Resume uploaded failde',
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'file not found',
            ]);
        }
    }

    public function joblistPage($id)
    {
        if ($id) {
            $data = DB::table("applications")
                ->leftJoin('jobs', "applications.job_id", '=', "jobs.id")
                ->leftJoin("users",  "applications.user_id", '=', "users.id")
                ->where("applications.user_id", "=", $id)
                ->select(
                    'jobs.*',
                    'applications.*',
                    'users.*',
                    "applications.id as applicationId",
                    DB::raw("DATE_FORMAT(jobs.created_at, '%d-%m-%y') as formatted_date")
                )
                ->get();
            // echo "<pre>";
            // print_r($data);
            // die;
            return view('jobseeker.joblist', [
                'jobs' => $data
            ]);
        }
    }
}
