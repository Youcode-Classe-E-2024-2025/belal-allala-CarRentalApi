<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\UpdatePaymentRequest;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;
use Stripe\Stripe;
use Stripe\Charge;
use Stripe\Exception\ApiErrorException;

/**
 * @OA\Tag(
 *     name="Payments",
 *     description="Operations related to payments"
 * )
 */
class PaymentController extends Controller
{
     /**
     * @OA\Get(
     *      path="/api/payments",
     *      operationId="getPaymentsList",
     *      tags={"Payments"},
     *      summary="Get list of payments",
     *      description="Returns list of payments",
     *   @OA\Parameter(
     *          name="page",
     *          description="Page number",
     *          required=false,
     *          in="query",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     *     )
     */
    public function index(Request $request)
    {
        $query = Payment::query();

        // Apply filters based on request parameters
        if ($request->has('rental_id')) {
            $query->where('rental_id', $request->input('rental_id'));
        }

        if ($request->has('payment_method')) {
            $query->where('payment_method', $request->input('payment_method'));
        }

        $payments = $query->paginate(10);
        return response()->json($payments);
    }

    /**
     * @OA\Post(
     *      path="/api/payments",
     *      operationId="createPayment",
     *      tags={"Payments"},
     *      summary="Create a new payment",
     *      description="Creates a new payment in the database",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StorePaymentRequest")
     *      ),
     *      @OA\Response(
     *          response=201,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      )
     * )
     */
    public function store(StorePaymentRequest $request)
    {
        $data = $request->validated();

        if ($request->payment_method === 'stripe') {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            try {
                $charge = Charge::create([
                    'amount' => $data['amount'] * 100, 
                    'currency' => 'eur',
                    'source' => $data['stripe_token'],
                    'description' => 'Paiement pour location de voiture',
                ]);

                $data['stripe_payment_id'] = $charge->id;
                $data['transaction_id'] = $charge->id; 
            } catch (ApiErrorException $e) {
                return response()->json(['error' => $e->getMessage()], 400);
            }
        }

        $payment = Payment::create($data);
        return response()->json($payment, 201);
    }

    /**
     * @OA\Get(
     *      path="/api/payments/{id}",
     *      operationId="getPaymentById",
     *      tags={"Payments"},
     *      summary="Get payment information",
     *      description="Returns payment data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Payment id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     *     )
     */
    public function show(string $id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }
        return response()->json($payment);
    }

     /**
     * @OA\Put(
     *      path="/api/payments/{id}",
     *      operationId="updatePayment",
     *      tags={"Payments"},
     *      summary="Update existing payment",
     *      description="Updates an existing payment in the database",
     *      @OA\Parameter(
     *          name="id",
     *          description="Payment id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdatePaymentRequest")
     *      ),
     *      @OA\Response(
     *          response=202,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=400,
     *          description="Bad Request"
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function update(UpdatePaymentRequest $request, string $id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }
        $payment->update($request->validated());
        return response()->json($payment);
    }

    /**
     * @OA\Delete(
     *      path="/api/payments/{id}",
     *      operationId="deletePayment",
     *      tags={"Payments"},
     *      summary="Delete existing payment",
     *      description="Deletes an existing payment in the database",
     *      @OA\Parameter(
     *          name="id",
     *          description="Payment id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\Response(
     *          response=204,
     *          description="Successful operation"
     *       ),
     *      @OA\Response(
     *          response=401,
     *          description="Unauthenticated",
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Forbidden"
     *      ),
     *      @OA\Response(
     *          response=404,
     *          description="Resource Not Found"
     *      )
     * )
     */
    public function destroy(string $id)
    {
        $payment = Payment::find($id);
        if (!$payment) {
            return response()->json(['message' => 'Payment not found'], 404);
        }
        $payment->delete();
        return response()->json(['message' => 'Payment deleted']);
    }
}