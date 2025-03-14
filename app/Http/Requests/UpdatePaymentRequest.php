<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Update Payment Request",
 *      description="Update Payment request body data",
 *      type="object"
 * )
 */
class UpdatePaymentRequest extends FormRequest
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
            'rental_id' => 'exists:rentals,id',
            'payment_date' => 'date',
            'amount' => 'numeric|min:0',
            'payment_method' => 'in:credit_card,paypal,cash',
            'transaction_id' => 'nullable|string',
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
     *      enum={"credit_card", "paypal", "cash"}
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
}