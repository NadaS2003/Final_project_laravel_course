<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Assignment;
use App\Models\Place;
use App\Models\Task;
use App\Models\Volunteer;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {

        $volunteers = Volunteer::count();
        $places = Place::count();
        $tasks = Task::count();
        $assigned = Assignment::distinct('volunteer_id')->count();


        $barChartData = Assignment::selectRaw('places.name as place_name, COUNT(assignments.volunteer_id) as count')
            ->join('places', 'assignments.place_id', '=', 'places.id')
            ->groupBy('places.name')
            ->get();

        $bar_chart_labels = $barChartData->pluck('place_name');
        $bar_chart_data = $barChartData->pluck('count');

        $pieChartData = Assignment::selectRaw('tasks.name as task_name, COUNT(assignments.id) as count')
            ->join('tasks', 'assignments.task_id', '=', 'tasks.id')
            ->groupBy('tasks.name')
            ->get();

        $pie_chart_labels = $pieChartData->pluck('task_name');
        $pie_chart_data = $pieChartData->pluck('count');

        $latest_assignments = Assignment::latest()
            ->with(['volunteer', 'place', 'task'])
            ->take(5)
            ->get()
            ->map(function ($assignment) {
                return [
                    'first_name' => $assignment->volunteer->first_name ?? '—',
                    'last_name' => $assignment->volunteer->last_name ?? '—',
                    'email' => $assignment->volunteer->email ?? '—',
                    'place' => $assignment->place->name ?? '—',
                    'task' => $assignment->task->name ?? '—',
                ];
            });

        return response()->json([
            'volunteers' => $volunteers,
            'places' => $places,
            'tasks' => $tasks,
            'assigned' => $assigned,
            'bar_chart_labels' => $bar_chart_labels,
            'bar_chart_data' => $bar_chart_data,
            'pie_chart_labels' => $pie_chart_labels,
            'pie_chart_data' => $pie_chart_data,
            'latest_volunteers' => $latest_assignments,
        ]);
    }
}
