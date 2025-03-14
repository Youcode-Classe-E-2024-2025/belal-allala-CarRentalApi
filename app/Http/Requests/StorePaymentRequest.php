<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Store Payment Request",
 *      description="Store Payment request body data",
 *      type="object",
 *      required={"rental_id", "payment_date", "amount", "payment_method"}
 * )
 */
class StorePaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'rental_id' => 'required|exists:rentals,id',
            'payment_date' => 'required|date',
            'amount' => 'required|numeric|min:0',
            'payment_method' => 'required|in:credit_card,paypal,cash,stripe', // Ajoutez 'stripe'
            'transaction_id' => 'nullable|string',
            'stripe_token' => 'required_if:payment_method,stripe', // Ajoutez cette règle
        ];
    }

    /**
     * @OA\Property(
     *      title="rental_id",
     *      description="Rental ID",
     *      example=1
     * )
     *
     * @var int
     */
    public $rental_id;

    /**
     * @OA\Property(
     *      title="payment_date",
     *      description="Payment date",
     *      example="2025-03-18"
     * )
     *
     * @var string
     */
    public $payment_date;

    /**
     * @OA\Property(
     *      title="amount",
     *      description="Payment amount",
     *      example=250.00
     * )
     *
     * @var float
     */
    public $amount;

    /**
     * @OA\Property(
     *      title="payment_method",
     *      description="Payment method",
     *      example="credit_card",
     *      enum={"credit_card", "paypal", "cash", "stripe"} 
     * )
     *
     * @var string
     */
    public $payment_method;

    /**
     * @OA\Property(
     *      title="transaction_id",
     *      description="Transaction ID",
     *      example="TX123456789"
     * )
     *
     * @var string
     */
    public $transaction_id;

    /**
     * @OA\Property(
     *      title="stripe_token",
     *      description="Stripe payment token",
     *      example="tok_visa"
     * )
     *
     * @var string
     */
    public $stripe_token; 
}