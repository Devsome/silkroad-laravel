<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Tickets\Ticket;
use App\Tickets\TicketAnswer;
use App\Tickets\TicketCategories;
use App\Tickets\TicketPrioritys;
use App\Tickets\TicketStatus;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class TicketController extends Controller
{
    /**
     * Showing all the Tickets from the Account
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function tickets()
    {
        $account = User::where('id', Auth::id())
            ->with('getTbUser.getSkSilk')
            ->firstOrFail();

        return view('frontend.account.tickets.index', [
            'account' => $account
        ]);
    }

    /**
     * Getting for the Datatables the Ticket for the Account
     * @return mixed
     * @throws \Exception
     */
    public function ticketsDatatables()
    {
        return DataTables::of(
            Ticket::query()
                ->with('getStatusName')
                ->with('getPriorityName')
                ->where('user_id', Auth::id())
        )->make(true);
    }

    /**
     * Showing the form for creating a new Ticket
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ticketsNew()
    {
        $account = User::where('id', Auth::id())
            ->with('getTbUser.getSkSilk')
            ->firstOrFail();

        $ticketCategories = TicketCategories::all();
        $ticketPrioritys = TicketPrioritys::all();

        return view('frontend.account.tickets.new', [
            'account' => $account,
            'ticketCategories' => $ticketCategories,
            'ticketPrioritys' => $ticketPrioritys
        ]);
    }

    /**
     * Submitting a new Ticket for this Account
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ticketsNewSubmit(Request $request)
    {
        User::findOrFail(
            Auth::id()
        );

        $this->validate($request, [
            '_token' => 'required',
            'title' => ['required', 'string', 'min:2', 'max:16'],
            'category' => ['required', 'integer', 'exists:ticket_categories,id'],
            'prioritys' => ['required', 'integer', 'exists:ticket_prioritys,id'],
            'body' => ['required', 'min:10'],
        ]);

        $ticketId = Ticket::insertGetId([
            'user_id' => Auth::id(),
            'ticket_categories_id' => $request->get('category'),
            'ticket_prioritys_id' => $request->get('prioritys'),
            'title' => $request->get('title'),
            'body' => $request->get('body'),
            'ticket_status_id' => TicketStatus::STATUS_NEW,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        TicketAnswer::create([
            'ticket_id' => $ticketId,
            'user_id' => Auth::id(),
            'body' => $request->get('body')
        ]);

        return redirect()->route('home-tickets')->with('success', __('home.settings.form.successfully'));
    }

    /**
     * @param $ticketId
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function ticketShow($ticketId)
    {
        $account = User::where('id', Auth::id())
            ->with('getTbUser.getSkSilk')
            ->firstOrFail();

        $ticket = Ticket::where('id', $ticketId)
            ->where('user_id', Auth::id())
            ->with('getAnswers')
            ->with('getStatusName')
            ->with('getPriorityName')
            ->with('getCategoryName')
            ->firstOrFail();

        return view('frontend.account.tickets.show', [
            'account' => $account,
            'ticket' => $ticket
        ]);
    }

    /**
     * @param Request $request
     * @param $ticketId
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ticketShowSubmit(Request $request, $ticketId)
    {
        User::findOrFail(
            Auth::id()
        );

        // Checking if this ticket is from this Account
        $ticketCheck = Ticket::where('id', $ticketId)
            ->where('user_id', Auth::id())
            ->get();

        if($ticketCheck->isEmpty()) {
            return redirect()->back()->with('error', __('home.tickets.show.form.wrong-owner'));
        }

        $this->validate($request, [
            '_token' => 'required',
            'body' => ['required', 'min:10']
        ]);

        // @Todo Reopen and change state!

        TicketAnswer::create([
            'ticket_id' => $ticketId,
            'user_id' => Auth::id(),
            'body' => $request->get('body')
        ]);

        return redirect()->back()->with('success', __('home.tickets.show.form.successfully'));
    }
}
