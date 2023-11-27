<?php 

namespace App\Http\Controllers\Api;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\TransactionService;
use App\Transformers\TransactionTransformer;
use App\Http\Requests\TransactionRequest;
class TransactionController extends Controller
{
    private TransactionService $transactionService;

    public function __construct(TransactionService $transactionService)
    {
        $this->TransactionService = $transactionService;
    }
    
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index(Request $request)
    {
        list($transactions,$count) = $this->TransactionService->index($request);

  
          return response()->json([
              'data' => $transactions,
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
        $this->TransactionService->create($request);
        return $this->dataResponse(null, trans('messages.success'), 200);
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
         $transaction  = $this->TransactionService->show($id);
         if(!$transaction)
         {
            return $this->errorResponse(trans('messages.not_found'), null, 404);
         }
         $transaction =  fractal()
                              ->item($transaction)
                              ->transformWith(new TransactionTransformer())
                              ->serializeWith(new \Spatie\Fractalistic\ArraySerializer())
                              ->includeSkills()
                              ->includeQuestions()
                              ->toArray();

        return $this->dataResponse($transaction, trans('messages.success'), 200);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(TransactionRequest $request, $id)
    {
        list($transaction,$message,$status) = $this->TransactionService->update($request,$id);

        if(!$transaction)
        {
            return $this->errorResponse($message, null, $status);
        }

        $transaction =  fractal()
                           ->item($transaction)
                           ->transformWith(new TransactionTransformer())
                           ->serializeWith(new \Spatie\Fractalistic\ArraySerializer())
                           ->toArray();
        return $this->dataResponse( $transaction, $message, 200);
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Request $request,$id)
    {
        list($transaction,$message,$status) =  $this->TransactionService->delete($request,$id);

        if($status != 200)
        {
            return $this->errorResponse($message, null, $status);
        }
        return $this->dataResponse(null, $message, $status);

    }


}
