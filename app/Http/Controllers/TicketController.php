<?php

namespace App\Http\Controllers;

use App\Tickets\Ticket;
use App\Tickets\TicketCategories;
use App\Tickets\TicketPrioritys;
use App\Tickets\TicketStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Validator;
use Yajra\DataTables\DataTables;

class TicketController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('backend.tickets.index', [
            'ticket-count' => Ticket::count(),
            'categories' => TicketCategories::all(),
            'prioritys' => TicketPrioritys::all(),
            'status' => TicketStatus::all()
        ]);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function indexDatatables()
    {
        return DataTables::of(Ticket::query())->make(true);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function statusUpdate($id, Request $request)
    {
        $status = TicketStatus::find($id);

        if ($request->getMethod() === 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:2|max:100',
                'color' => 'required',
                '_token' => 'required'
            ]);

            if ($validator->fails()) {
                return Redirect::action('TicketController@statusUpdate', ['id' => $id])
                    ->withInput()
                    ->withErrors($validator);
            }

            $status->name = $request->get('name');
            $status->color = $request->get('color');
            $status->save();

            return response('saved', 200);
        }

        return view('backend.tickets.update-status-modal', [
            'status' => $status,
            'colors' => TicketStatus::COLORS
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function statusCreate(Request $request)
    {
        if ($request->getMethod() === 'POST') {
            $validator = Validator::make($request->all(), [
                'name' => 'required|min:2|max:100',
                'color' => 'required',
                '_token' => 'required'
            ]);

            if ($validator->fails()) {
                return Redirect::action('TicketController@statusCreate')
                    ->withInput()
                    ->withErrors($validator);
            }

            TicketStatus::create([
                'name' => $request->get('name'),
                'color' => $request->get('color')
            ]);

            return response('saved', 200);
        }
        return view('backend.tickets.update-status-modal', [
            'status' => null,
            'colors' => TicketStatus::COLORS
        ]);
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function statusDelete($id, Request $request)
    {
        TicketStatus::findOrFail($id)->delete();
        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * @param $id
     * @param Request $request
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function categoryUpdate($id, Request $request)
    {
        $category = TicketCategories::find($id);

        if ($request->getMethod() === 'POST')
        {
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
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
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
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function priorityUpdate($id, Request $request)
    {
        $priority = TicketPrioritys::find($id);

        if ($request->getMethod() === 'POST')
        {
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
     * @return \Illuminate\Contracts\Routing\ResponseFactory|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\View\View
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
}
