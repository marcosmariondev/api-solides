<?php


namespace App\Http\Controllers\Api;


use App\Http\Controllers\Controller;
use App\PointRecord;
use Carbon\Carbon;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function listPoints(Request $request) {

        $records = PointRecord::whereUserId(\Auth::id())->get();

        return response()->json($records);
    }

    public function addPoints(Request $request)
    {

        try {

            $request->validate([
                "beginning_day" => 'nullable|date_format:H:i',
                "out_lunch" => 'nullable|date_format:H:i',
                "back_lunch" => 'nullable|date_format:H:i',
                "end_day" => 'nullable|date_format:H:i',
            ]);

            $point = PointRecord::firstOrNew(
                ['day' => Carbon::today(),
                    'user_id' => \Auth::id()]
            );

            if ($request->beginning_day)
                $point->beginning_day = $request->beginning_day;

            if ($request->out_lunch)
                $point->out_lunch = $request->out_lunch;

            if ($request->back_lunch)
                $point->back_lunch = $request->back_lunch;

            if ($request->end_day)
                $point->end_day = $request->end_day;

            $point->save();

            return response()->json($point);

        } catch (\Exception $e) {

            return response()->json([
                'message' => $e->getMessage(),
                //      'errors' => $e->errors()
            ], 403);

        }

    }
}