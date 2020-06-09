<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
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

class TicketController extends Controller
{
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

    /**
     * @param Request $request
     * @return array
     */
    public function close(Request $request)
    {
        $ticket = Ticket::find($request->conversationId);

        if ($ticket->ticket_status_id === TicketStatus::STATUS_CLOSED) {
            $state = TicketStatus::STATUS_FINAL_CLOSE;
        } else {
            $state = TicketStatus::STATUS_CLOSED;
        }
        $ticket->update([
            'ticket_status_id' => $state
        ]);

        return ['success' => true];
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
                return Redirect::action('Backend\TicketController@categoryUpdate', ['id' => $id])
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
                return Redirect::action('Backend\TicketController@categoryCreate')
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
        $ticketsWithPriority = Ticket::where('ticket_categories_id', '=', $id)->get();

        if ($ticketsWithPriority->count() > 0) {
            return back()->with('error', trans('backend/notification.form-submit.category-exist'));
        }
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
                return Redirect::action('Backend\TicketController@priorityUpdate', ['id' => $id])
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
                return Redirect::action('Backend\TicketController@priorityCreate')
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
        $ticketsWithPriority = Ticket::where('ticket_prioritys_id', '=', $id)->get();

        if ($ticketsWithPriority->count() > 0) {
            return back()->with('error', trans('backend/notification.form-submit.priority-exist'));
        }
        TicketPrioritys::findOrFail($id)->delete();
        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * @param Ticket|null $ticket
     * @return mixed
     */
    protected function getConversationsInOrder(Ticket $ticket = null)
    {
        $query = TicketAnswer::select(['ticket_id', DB::raw('MAX(created_at) as created_at')])
            ->orderBy('created_at', 'desc')
            ->with('conversation')
            ->groupBy('ticket_id');

        if (!is_null($ticket)) {
            $query->whereHas('conversation', static function ($query) use ($ticket) {
                $query->where('ticket_id', $ticket->id);
            });
        }

        return $query->get()->pluck('conversation');
    }

    /**
     * @param Ticket|null $ticket
     * @return Factory|\Illuminate\View\View
     */
    public function list(Ticket $ticket = null)
    {
        $conversations = $this->getConversationsInOrder($ticket);
        if (is_null($ticket)) {
            $currentTicket = $conversations->first();
        } else {
            $currentTicket = $ticket;
        }

        return view('backend.tickets.conversations.list', [
            'conversations' => $conversations,
            'currentConversation' => $currentTicket,
        ]);
    }

    /**
     * @param Request $request
     * @param Ticket|null $ticket
     * @return Factory|\Illuminate\View\View
     */
    public function fetchConversations(Request $request, Ticket $ticket = null)
    {
        $conversations = $this->getConversationsInOrder($ticket);
        return view('backend.tickets.conversations.conversations', [
            'conversations' => $conversations,
            'conversationId' => $request->conversationId,
        ]);
    }

    /**
     * @param Request $request
     * @param Ticket|null $ticket
     * @return array
     * @throws \Throwable
     */
    public function fetch(Request $request, Ticket $ticket = null)
    {
        $conversation = Ticket::find($request->conversationId);

        if (!is_null($ticket) && $conversation->project_id != $ticket->id)
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

    /**
     * @param Request $request
     * @param Ticket|null $ticket
     * @return array
     */
    public function send(Request $request, Ticket $ticket = null)
    {
        $conversation = Ticket::find($request->conversationId);

        if ($conversation->ticket_status_id === TicketStatus::STATUS_FINAL_CLOSE) {
            return ['success' => false];
        }

        if ($ticket && $conversation->project_id !== $ticket->id)
            return ['success' => false];

        if (!$conversation || !$request->has('text') || !$request->text)
            return ['success' => false];

        if ($conversation->ticket_status_id === TicketStatus::STATUS_CLOSED) {
            Ticket::findOrFail($request->conversationId)->update([
                'ticket_status_id' => TicketStatus::STATUS_REOPEN
            ]);
        } else {
            Ticket::findOrFail($request->conversationId)->update([
                'ticket_status_id' => TicketStatus::STATUS_PENDING
            ]);
        }

        TicketAnswer::create([
            'ticket_id' => $request->conversationId,
            'user_id' => \Auth::id(),
            'body' => $request->text
        ]);

        return ['success' => true];
    }
}
