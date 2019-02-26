<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Logger;
use App\History;

class LoggerController extends Controller
{
    public function index()
    {
        $loggers = Logger::all();

        return response($loggers->jsonSerialize(), Response::HTTP_OK);
    }

    public function log(Request $request){
        $logs = $request->all()['logs'];
      
        foreach ($logs as $key => $log) {
            $history = new History;
            $history->id = $log['id'];
            $history->value = $log['value'];
            $history->save();
        }

        return response()->json([
            'message' => 'Succesfuldt logged.'
        ], 200);
    }

    public function store(Request $request){
        $this->validate($request, [
            'question' => 'required'
        ]);

        $logger = new Logger;
        $logger->question = $request->input('question');
        $logger->type = $request->input('type');
        $logger->save();

        return response()->json([
            'message' => 'Succesfuldt oprettet ny logger.'
        ], 200);
    }

    public function destroy($id) {
        $logger = Logger::find($id);

        $logger->delete();

        return response()->json([
            'message' => 'Successfully delete of logger'
        ], 200);

    }
}
