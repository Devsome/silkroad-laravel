<?php

namespace App\Http\Controllers\Frontend;

use App\DataTables\Frontend\Account\TicketsDataTable;
use App\Http\Controllers\Controller;
use App\Tickets\Ticket;
use App\Tickets\TicketAnswer;
use App\Tickets\TicketCategories;
use App\Tickets\TicketPrioritys;
use App\Tickets\TicketStatus;
use App\User;
use Carbon\Carbon;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Yajra\DataTables\DataTables;

class TicketController extends Controller
{
    /**
     * Showing all the Tickets from the Account
     *
     * @param TicketsDataTable $dataTable
     * @return Factory|View
     */
    public function tickets(TicketsDataTable $dataTable)
    {
        $account = User::where('id', Auth::id())
            ->with('getTbUser.getSkSilk')
            ->firstOrFail();

        return $dataTable->render('theme::frontend.account.tickets.index', [
            'account' => $account
        ]);
    }


    /**
     * Showing the form for creating a new Ticket
     *
     * @return Factory|View
     */
    public function ticketsNew()
    {
        $account = User::where('id', Auth::id())
            ->with('getTbUser.getSkSilk')
            ->firstOrFail();

        $ticketCategories = TicketCategories::all();
        $ticketPrioritys = TicketPrioritys::all();

        return view('theme::frontend.account.tickets.new', [
            'account' => $account,
            'ticketCategories' => $ticketCategories,
            'ticketPrioritys' => $ticketPrioritys
        ]);
    }

    /**
     * Submitting a new Ticket for this Account
     *
     * @param Request $request
     * @return RedirectResponse
     * @throws ValidationException
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
     * @return Factory|View
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

        return view('theme::frontend.account.tickets.show', [
            'account' => $account,
            'ticket' => $ticket
        ]);
    }

    /**
     * @param Request $request
     * @param $ticketId
     * @return RedirectResponse
     * @throws ValidationException
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

        if ($ticketCheck->isEmpty()) {
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
