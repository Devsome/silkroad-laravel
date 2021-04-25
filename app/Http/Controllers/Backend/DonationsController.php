<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\Backend\Donations\MaxiCard\MaxiCardDataTable;
use App\DonationMaxiCard;
use App\DonationMaxiCardLog;
use App\DonationMethods;
use App\DonationPaypals;
use App\DonationStripes;
use App\Http\Controllers\Controller;
use App\PaypalInvoices;
use App\StripeInvoices;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Validator;
use DataTables;
use Yajra\DataTables\Html\Builder;

class DonationsController extends Controller
{
    /**
     * @return Factory|View
     */
    public function index()
    {
        $donationMethods = DonationMethods::all();

        return view('backend.donations.index', [
            'donationMethods' => $donationMethods
        ]);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function loggingPaypalDatatables()
    {
        return DataTables::of(PaypalInvoices::where('state', '=', PaypalInvoices::STATE_PAID))
            ->make(true);
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function loggingStripeDatatables()
    {
        return DataTables::of(StripeInvoices::where('state', '=', PaypalInvoices::STATE_PAID))
            ->make(true);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function updateMethods(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            '_token' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withInput()
                ->withErrors($validator);
        }

        // More then the _token
        if ($request->all() > 1) {
            // Setting all to 0
            DonationMethods::query()->update(['active' => false]);

            // Looping the request
            foreach ($request->all() as $key => $data) {
                if ($key === '_token') {
                    continue;
                }
                DonationMethods::where('id', '=', $key)
                    ->update(['active' => $data ? true : false]);
            }
        }

        return back()->with('success', trans('backend/notification.form-submit.success'));
    }

    /**
     * @return Factory|View
     */
    public function methodPaypal()
    {
        $method = DonationMethods::where('method', '=', 'paypal')
            ->firstOrFail();

        $paypal = DonationPaypals::all();

        return view('backend.donations.paypal', [
            'method' => $method,
            'paypal' => $paypal
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function methodPaypalAdding(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            '_token' => 'required',
            'name' => 'required|max:50',
            'description' => 'required|max:250',
            'price' => 'required|numeric|min:0|not_in:0',
            'silk' => 'required|integer|min:0|not_in:0',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        DonationPaypals::create($request->all());

        return back()->with('success', __('backend/notification.form-submit.success'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function methodPaypalDestroy(Request $request, $id): RedirectResponse
    {
        DonationPaypals::findOrFail($id)->delete();

        return back()->with('success', __('backend/notification.form-submit.success'));
    }

    /**
     * @return Factory|View
     */
    public function methodStripe()
    {
        $method = DonationMethods::where('method', '=', 'stripe')
            ->firstOrFail();

        $stripe = DonationStripes::all();

        return view('backend.donations.stripe', [
            'method' => $method,
            'stripe' => $stripe
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function methodStripeAdding(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            '_token' => 'required',
            'name' => 'required|max:50',
            'description' => 'required|max:250',
            'price' => 'required|numeric|min:0|not_in:0',
            'silk' => 'required|integer|min:0|not_in:0',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        DonationStripes::create($request->all());

        return back()->with('success', __('backend/notification.form-submit.success'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return RedirectResponse
     */
    public function methodStripeDestroy(Request $request, $id): RedirectResponse
    {
        DonationStripes::findOrFail($id)->delete();

        return back()->with('success', __('backend/notification.form-submit.success'));
    }

    /**
     * @param MaxiCardDataTable $dataTable
     * @return Factory|View
     */
    public function methodMaxicard(MaxiCardDataTable $dataTable)
    {
        $method = DonationMethods::where('method', '=', 'maxicard')
            ->firstOrFail();

        $columns = [
            'id' => [
                'data' => 'id',
                'name' => 'log_id',
                'title' => '#',
                'footer' => '#',
                'visible' => true,
                'orderable' => true,
                'searchable' => true,
                'width' => 40,
                'className' => 'align-middle'
            ],
            'user_id' => [
                'data' => 'user_id',
                'name' => 'user_id',
                'title' => __('backend/donations.logging.table.user_id'),
                'footer' => __('backend/donations.logging.table.user_id'),
                'visible' => true,
                'orderable' => true,
                'searchable' => true,
                'width' => 60,
                'className' => 'align-middle'
            ],
            'user.name' => [
                'data' => 'user.name',
                'name' => 'user.name',
                'title' => __('backend/donations.logging.table.name'),
                'footer' => __('backend/donations.logging.table.name'),
                'visible' => true,
                'orderable' => true,
                'searchable' => true,
                'className' => 'align-middle'
            ],
            'epin.price' => [
                'data' => 'epin.price',
                'name' => 'epin.price',
                'title' => __('backend/donations.logging.table.price'),
                'footer' => __('backend/donations.logging.table.price'),
                'visible' => true,
                'orderable' => true,
                'searchable' => true,
                'className' => 'align-middle'
            ],
            'silk' => [
                'data' => 'epin_amount',
                'name' => 'epin_amount',
                'title' => __('backend/donations.logging.table.silk'),
                'footer' => __('backend/donations.logging.table.silk'),
                'visible' => true,
                'orderable' => true,
                'searchable' => true,
                'className' => 'align-middle'
            ],
            'created_at' => [
                'data' => 'created_at',
                'name' => 'created_at',
                'title' => __('backend/donations.logging.table.date'),
                'footer' => __('backend/donations.logging.table.date'),
                'visible' => true,
                'orderable' => true,
                'searchable' => true,
                'className' => 'align-middle'
            ],
        ];

        $logDataTable = app(Builder::class)
            ->columns($columns)
            ->ajax(route('donations-logging-maxicard-datatables-backend'))
            ->setTableId('maxicard-donations-log')
            ->parameters([
                'dom' => 'Bfrltip',
                'order' => [[0, 'asc']],
                'orderable' => true,
                'responsive' => true,
                "processing" => true,
                "info" => true,
                "searching" => true,
                'select' => false,
                "lengthMenu" => [[10, 25, 50, 100, 200, -1], [10, 25, 50, 100, 200, __('datatables.show-all')]],
                'language' => [
                    'search' => __('datatables.search'),
                    'zeroRecords' => __('datatables.zero'),
                    "info" => __('datatables.info'),
                    "infoEmpty" => __('datatables.empty'),
                    "infoFiltered" => __('datatables.info-filtered'),
                    "paginate" => [
                        "first" => __('datatables.first'),
                        "last" => __('datatables.last'),
                        "next" => ">",
                        "previous" => "<"
                    ],
                    'searchPlaceholder' => __('datatables.searchPlaceholder'),
                    'lengthMenu' => __('datatables.length'),
                    'processing' => __('datatables.processing'),
                    'buttons' => [
                        'reload' => __('datatables.reload'),
                        'print' => __('datatables.print'),
                        'colvis' => __('datatables.colvis'),
                    ]
                ],
                'buttons' => [
                    'reload',
                    'print',
                    'colvis',
                ],
            ])
            ->selectAddClassName('selected');

        return $dataTable->render('backend.donations.maxicard', compact('method', 'logDataTable'));
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function methodMaxicardAdding(Request $request): RedirectResponse
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required','max:50', 'unique:maxi_card_epin,name'],
            'description' => 'required|max:250',
            'price' => 'required|numeric|min:0|not_in:0',
            'silk' => 'required|integer|min:0|not_in:0',
        ]);

        if ($validator->fails()) {
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        DonationMaxiCard::create($request->all());

        return back()->with('success', __('backend/notification.form-submit.success'));
    }

    /**
     * @param Request $request
     * @param $id
     * @return bool
     * @throws Exception
     */
    public function methodMaxicardDestroy(Request $request, $id): bool
    {
        DB::beginTransaction();
        try {
            DonationMaxiCard::findOrFail($id)->delete();
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
        DB::commit();
        return true;
    }

    /**
     * @param Request $request
     * @param $id
     * @return bool|JsonResponse
     * @throws ValidationException
     * @throws Exception
     */
    public function methodMaxicardEdit(Request $request, $id)
    {
        $maxicard = DonationMaxiCard::where('id', $id)
            ->first();

        if (!$maxicard) {
            return response()->json('There is no Maxicard found with that id.', 404);
        }

        $this->validate($request, [
            'name' => ['required', "unique:maxi_card_epin,name,{$id}"],
            'description' => ['nullable'],
            'price' => ['required', 'numeric'],
            'silk' => ['required', 'numeric'],
        ]);

        DB::beginTransaction();
        try {
            $maxicard->update([
                'name' => $request->get('name'),
                'description' => $request->get('description'),
                'price' => $request->get('price'),
                'silk' => $request->get('silk'),
            ]);
        } catch (Exception $e) {
            DB::rollBack();
            return false;
        }
        DB::commit();
        return true;
    }

    /**
     * @return mixed
     * @throws Exception
     */
    public function loggingMaxicardDatatables()
    {
        return DataTables::of(DonationMaxiCardLog::with('user', 'epin')->get())
            ->editColumn('created_at', function ($data = '$query') {
                return Carbon::make($data->created_at)->diffForHumans();
            })
            ->escapeColumns()
            ->rawColumns([
                'created_at',
            ])
            ->make(true);
    }

    /**
     * @param $id
     * @return array|JsonResponse
     */
    public function getMaxicardData($id)
    {
        $maxicard = DonationMaxiCard::where('id', $id)
            ->first();

        if (!$maxicard) {
            return response()->json('There is no Maxicard found with that id.', 404);
        }

        return [
            'maxicard' => $maxicard
        ];
    }
}
