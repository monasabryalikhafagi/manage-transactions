<?php 

namespace App\Http\Controllers\Web;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use App\Http\Requests\TransactionRequest;
use App\Http\Resources\TransactionResourse;
class TransactionController extends Controller
{
    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->transactionService = $transactionService;
    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        list($transactions,$count) = $this->transactionService->index($request);

  
          return response()->json([
              'data' => TransactionResourse::collection($transactions),
              'count' => $count,
              'status' => true,
          ], 200);
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(TransactionRequest $request)
    {
         $this->transactionService->create($request);

        return $this->dataResponse(null, trans('messages.success'), 200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
         $transaction  = $this->transactionService->show($id);
         if(!$transaction)
         {
            return $this->errorResponse(trans('messages.not_found'), null, 404);
         }


        return $this->dataResponse(new TransactionResourse($transaction), "success", 200);
    }



}
