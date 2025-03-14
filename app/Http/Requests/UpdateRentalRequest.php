<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *      title="Update Rental Request",
 *      description="Update Rental request body data",
 *      type="object"
 * )
 */
class UpdateRentalRequest extends FormRequest
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
            'user_id' => 'exists:users,id',
            'car_id' => 'exists:cars,id',
            'start_date' => 'date',
            'end_date' => 'date|after:start_date',
            'rental_rate' => 'numeric|min:0',
            'total_amount' => 'numeric|min:0',
            'status' => 'in:pending,active,completed,cancelled',
        ];
    }

    /**
     * @OA\Property(
     *      title="user_id",
     *      description="User ID",
     *      example=1
     * )
     *
     * @var int
     */
    public $user_id;

    /**
     * @OA\Property(
     *      title="car_id",
     *      description="Car ID",
     *      example=1
     * )
     *
     * @var int
     */
    public $car_id;

    /**
     * @OA\Property(
     *      title="start_date",
     *      description="Start date of the rental",
     *      example="2025-03-15"
     * )
     *
     * @var string
     */
    public $start_date;

    /**
     * @OA\Property(
     *      title="end_date",
     *      description="End date of the rental",
     *      example="2025-03-20"
     * )
     *
     * @var string
     */
    public $end_date;

    /**
     * @OA\Property(
     *      title="rental_rate",
     *      description="Rental rate per day",
     *      example=50.00
     * )
     *
     * @var float
     */
    public $rental_rate;

    /**
     * @OA\Property(
     *      title="total_amount",
     *      description="Total amount of the rental",
     *      example=250.00
     * )
     *
     * @var float
     */
    public $total_amount;

    /**
     * @OA\Property(
     *      title="status",
     *      description="Status of the rental",
     *      example="active",
     *      enum={"pending", "active", "completed", "cancelled"}
     * )
     *
     * @var string
     */
    public $status;
}