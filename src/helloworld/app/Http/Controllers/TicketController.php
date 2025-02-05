<?php

namespace App\Http\Controllers;

use App\Http\Requests\Ticket\EditRequest;
use App\Http\Requests\Ticket\StoreRequest;
use App\Models\Ticket;
use Illuminate\Http\Request;
use Exception;

class TicketController extends Controller
{
    public function index() {
        try{
            $tickets = Ticket::all();
            if($tickets->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'message' => 'No tickets found'
                ]);
            }
            return response()->json([
                'success' => true,
                'data' => $tickets
            ], 200);
        }
        catch(Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(StoreRequest $request)
    {
        try {
            $ticket = Ticket::create($request->all());
            return response()->json([
                'success' => true,
                'message' => 'Ticket created successfully',
                'data' => $ticket
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function edit($id)
    {

        if (!is_numeric($id)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid ID provided'
            ], 400);
        }

        $ticket = Ticket::whereTicketId((int)$id)->first();

        if (!$ticket) {
            return response()->json([
                'success' => false,
                'message' => 'Ticket not found'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $ticket
        ], 200);
    }

    public function update(EditRequest $request, $id)
    {
        try {
            if (!is_numeric($id)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid ID provided'
                ], 400);
            }
            $ticket = Ticket::whereTicketId((int)$id)->first();
            if (!$ticket) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ticket not found'
                ], 404);
            }

            $updated = $ticket->update($request->only(['title', 'description', 'status']));
  
            if (!$updated) {
                return response()->json([
                    'success' => false,
                    'message' => 'Update failed, please check your input'
                ], 500);
            }

            return response()->json([
                'success' => true,
                'message' => 'Ticket updated successfully',
                'data' => $ticket
            ], 200);
        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id) {
        try{
            if (!is_numeric($id)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Invalid ID provided'
                ], 400);
            }

            $ticket = Ticket::whereTicketId((int)$id)->first();
            if (!$ticket) {
                return response()->json([
                    'success' => false,
                    'message' => 'Ticket not found'
                ], 404);
            }
            $ticket->delete();
            return response()->json([
                'success' => true,
                'message' => 'Ticket deleted successfully'
            ], 200);
        }
        catch(Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong!',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
