<?php 
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Report;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function find()
    {

        $reports = Report::with(['reporter', 'article']) // use correct relationship names
        ->latest()
        ->get()
        ->map(function ($report) {
            return [
                'report_id'   => $report->id,
                'reporter_id' => $report->reporter_id,
                'reporter'    => $report->reporter->name ?? 'Unknown',
                'reason'      => $report->reason,
                'article_id'  => $report->article->article_id ?? 'N/A',
                'issued_date' => Carbon::parse($report->created_at)->diffForHumans(),
            ];
        });

        return response()->json($reports);
  
    }

    public function deleteMany(Request $request)
    {
        $request->validate([
            'reportIds' => 'required|array|min:1',
            'reportIds.*' => 'integer|exists:reports,id',
        ]);

        try {
            Report::whereIn('id', $request->reportIds)->delete();

            return response()->json([
                'message' => 'Selected reports deleted successfully.'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete reports.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'problem' => 'required|string|max:255',
            'reporter_id' => 'required|integer|exists:users,id',
            'article_id' => 'required|integer|exists:articles,id',
        ]);

        try {
            $report = Report::findOrFail($id);
            $report->reporter_id = $request->reporter_id;
            $report->reason = $request->problem;
            $report->article_id = $request->article_id;
            $report->save();

            return response()->json([
                'message' => 'Report updated successfully.',
                'report' => [
                    'report_id' => $report->id,
                    'problem'    => $report->reason,
                    'article_id'    => $report->article_id,
                ],
            ], 200);
        } catch (e) {
            return response()->json([
                'message' => 'Report not found.',
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to update report.',
                'error'   => $e->getMessage(),
            ], 500);
        }
        }
    public function store(Request $request)
    {
        $request->validate([
            'problem' => 'required|string|max:255',
        ]);

        try {
            $report = new Report();
            $report->reporter_id = $request->user()->id; // Get current authenticated user ID
            $report->reason = $request->problem;
            $report->article_id = $request->article_id;
            $report->save();

            return response()->json([
                'message' => 'Report created successfully.',
                'report' => [
                    'report_id' => $report->id,
                    'reporter_id' => $report->reporter_id,
                    'problem' => $report->reason,
                    'article_id' => $report->article_id,
                ],
            ], 201);

        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to create report.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


}