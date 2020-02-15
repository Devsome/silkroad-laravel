<?php

namespace App\Http\Controllers;

use App\Tickets\Ticket;
use App\Tickets\TicketAnswer;
use App\Tickets\TicketCategories;
use App\Tickets\TicketPrioritys;
use App\Tickets\TicketStatus;
use DB;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Yajra\DataTables\DataTables;

class TicketController extends Controller
{
    /**
     * @param Request $request
     * @return Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $tickets = Ticket::with('getUserName')
            ->with('getCategoryName')
            ->with('getPriorityName')
            ->with('getStatusName')
            ->orderBy('updated_at', 'DESC')
            ->paginate(1);

        if ($request->ajax()) {
            return view('backend.tickets.chat-tickets', [
                'tickets' => $tickets,
            ]);
        }

        return view('backend.tickets.index', [
            'tickets' => $tickets,
            'ticket-count' => Ticket::count()
        ]);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function indexDatatables()
    {
        $tickets = Ticket::with('getUserName')
            ->with('getCategoryName')
            ->with('getPriorityName')
            ->with('getStatusName')
            ->select('tickets.*');

        return Datatables::of($tickets)
            ->make(true);
    }

    /**
     * @return Factory|\Illuminate\View\View
     */
    public function settings()
    {
        return view('backend.tickets.settings', [
            'categories' => TicketCategories::all(),
            'prioritys' => TicketPrioritys::all(),
            'status' => TicketStatus::all()
        ]);
    }


    public function showTicket(Request $request)
    {
        $ticketAnswer = TicketAnswer::where('ticket_id', '=', $request->get('id'));

        return view('backend.tickets.message-tickets', [
            'answers' => $ticketAnswer
        ]);

    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function categoryUpdate($id, Request $request)
    {
        $category = TicketCategories::find($id);

        if ($request->getMethod() === 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:2|max:100',
                '_token' => 'required'
            ]);

            if ($validator->fails()) {
                return Redirect::action('TicketController@categoryUpdate', ['id' => $id])
                    ->withInput()
                    ->withErrors($validator);
            }

            $category->name = $request->get('name');
            $category->save();

            return response('saved', 200);
        }

        return view('backend.tickets.update-category-modal', [
            'category' => $category,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function categoryCreate(Request $request)
    {
        if ($request->getMethod() === 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:2|max:100',
                '_token' => 'required'
            ]);

            if ($validator->fails()) {
                return Redirect::action('TicketController@categoryCreate')
                    ->withInput()
                    ->withErrors($validator);
            }

            TicketCategories::create([
                'name' => $request->get('name'),
            ]);

            return response('saved', 200);
        }
        return view('backend.tickets.update-category-modal', [
            'category' => null,
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function categoryDelete($id, Request $request)
    {
        TicketCategories::findOrFail($id)->delete();
        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function priorityUpdate($id, Request $request)
    {
        $priority = TicketPrioritys::find($id);

        if ($request->getMethod() === 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:2|max:100',
                'color' => 'required',
                '_token' => 'required'
            ]);

            if ($validator->fails()) {
                return Redirect::action('TicketController@priorityUpdate', ['id' => $id])
                    ->withInput()
                    ->withErrors($validator);
            }

            $priority->name = $request->get('name');
            $priority->color = $request->get('color');
            $priority->save();

            return response('saved', 200);
        }

        return view('backend.tickets.update-priority-modal', [
            'priority' => $priority,
            'colors' => TicketPrioritys::COLORS
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function priorityCreate(Request $request)
    {
        if ($request->getMethod() === 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:2|max:100',
                'color' => 'required',
                '_token' => 'required'
            ]);

            if ($validator->fails()) {
                return Redirect::action('TicketController@priorityCreate')
                    ->withInput()
                    ->withErrors($validator);
            }

            TicketPrioritys::create([
                'name' => $request->get('name'),
                'color' => $request->get('color'),
            ]);

            return response('saved', 200);
        }
        return view('backend.tickets.update-priority-modal', [
            'priority' => null,
            'colors' => TicketPrioritys::COLORS
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function priorityDelete($id, Request $request)
    {
        TicketPrioritys::findOrFail($id)->delete();
        return back()->with('success', trans('backend/notification.form-submit.success'));
    }



    /*
     * Chit Chat
     */

    protected function getConversationsInOrder(Ticket $ticket = null)
    {
        $query = TicketAnswer::select(['ticket_id', DB::raw('MAX(created_at) as created_at')])
            ->orderBy('created_at', 'desc')
            ->with('conversation')
            ->groupBy('ticket_id');

//        dd(
//            $query->get(),
//            $query->get()->pluck('ticket_id'),
//            $ticket
//        );

        if(!is_null($ticket))
            $query->whereHas('conversation', function ($query) use($ticket) {
                $query->where('ticket_id', $ticket->id);
            });

        return $query->get()->pluck('conversation');

    }

    public function list(Ticket $ticket = null)
    {
        $conversations = $this->getConversationsInOrder($ticket);
        if (is_null($ticket))
            $currentTicket = $conversations->first();
        else
            $currentTicket = $ticket;


//        dd($conversations,$currentTicket, $ticket);
        return view('backend.tickets.conversations.list', [
            'conversations' => $conversations,
            'currentConversation' => $currentTicket,
        ]);
    }

    public function fetchConversations(Request $request, Ticket $ticket = null)
    {
        $conversations = $this->getConversationsInOrder($ticket);
        return view('backend.tickets.conversations.conversations', [
            'conversations' => $conversations,
            'conversationId' => $request->conversationId,
        ]);
    }

    public function fetch(Request $request, Ticket $ticket = null)
    {
        $conversation = Ticket::find($request->conversationId);

        if(!is_null($ticket) && $conversation->project_id != $ticket->id)
            return ['success' => false];

        if (is_null($conversation))
            return ['success' => false];

        $query = $conversation->getAnswers()->where('ticket_id', $conversation->id)->orderBy('created_at', 'asc');
        if ($request->has('lastMessage'))
            $query->where('created_at', '>', Carbon::rawCreateFromFormat(Carbon::ISO8601, $request->lastMessage));
        $messages = $query->get();

        return [
            'found' => $messages->count() != 0,
            'lastMessage' => $messages->count() == 0 ? '' : $messages->last()->created_at->toIso8601String(),
            'html' => view('backend.tickets.conversations.chat', [
                'messages' => $messages,
                'ticket' => $conversation
            ])->render(),
            'success' => true,
        ];
    }

    public function send(Request $request, Ticket $ticket = null)
    {
        $conversation = Ticket::find($request->conversationId);

        if(!is_null($ticket) && $conversation->project_id != $ticket->id)
            return ['success' => false];

        if (is_null($conversation) || !$request->has('text') || is_null($request->text))
            return ['success' => false];


        TicketAnswer::create([
            'ticket_id' => $request->conversationId,
            'user_id' => \Auth::id(),
            'body' => $request->text
        ]);

//        $job = new InstagramJob();
//        $job->type = InstagramJob::TypeMessageSend;
//        $job->data = json_encode($data);
//        $job->save();

        return ['success' => true];
    }

//    public function projectList(Project $project, Ticket $conversation = null)
//    {
//        return $this->list($conversation, $project);
//    }

}
