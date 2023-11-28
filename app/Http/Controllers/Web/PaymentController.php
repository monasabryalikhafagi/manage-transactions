<?php 

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\Http\Resources\PaymentResource;
use App\Services\PaymentService;
use App\Http\Controllers\Controller;

class PaymentController extends Controller 
{

  private PaymentService $paymentService;

  public function __construct(PaymentService $paymentService)
  {
      $this->paymentService = $paymentService;
  }
  
  /**
   * Display a listing of the resource.
   * @return Renderable
   */
  public function index(Request $request)
  {
      list($payments,$count) = $this->paymentService->index($request);
        return response()->json([
            'data' => PaymentResource::collection($payments),
            'count' => $count,
            'status' => true,
        ], 200);
  }

  /**
   * Store a newly created resource in storage.
   * @param Request $request
   * @return Renderable
   */
  public function store(PaymentRequest $request)
  {
       $this->paymentService->create($request);
      return $this->dataResponse(null, trans('messages.success'), 200);
  }

  /**
   * Show the specified resource.
   * @param int $id
   * @return Renderable
   */
  public function show($id)
  {
       $payment  = $this->paymentService->show($id);
       if(!$payment)
       {
          return $this->errorResponse(trans('messages.not_found'), null, 404);
       }


      return $this->dataResponse(new PaymentResource($payment), trans('messages.success'), 200);
  }
  
}

?>