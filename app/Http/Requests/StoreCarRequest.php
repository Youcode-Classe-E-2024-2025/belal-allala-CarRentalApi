<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      title="Store Car Request",
 *      description="Store Car request body data",
 *      type="object",
 *      required={"brand", "model", "year", "color", "registration_number", "mileage", "daily_rate"}
 * )
 */
class StoreCarRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // You can add authorization logic here if needed
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'brand' => 'required|string|max:255',
            'model' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:' . date('Y'),
            'color' => 'required|string|max:255',
            'registration_number' => 'required|string|unique:cars,registration_number',
            'mileage' => 'required|integer|min:0',
            'daily_rate' => 'required|numeric|min:0',
            'availability' => 'boolean',
            'image_path' => 'nullable|string',
        ];
    }

    /**
     * @OA\Property(
     *      title="brand",
     *      description="Brand of the car",
     *      example="Renault"
     * )
     *
     * @var string
     */
    public $brand;

    /**
     * @OA\Property(
     *      title="model",
     *      description="Model of the car",
     *      example="Clio"
     * )
     *
     * @var string
     */
    public $model;

     /**
      * @OA\Property(
      *      title="year",
      *      description="Year of the car",
      *      example="2020"
      * )
      *
      * @var integer
      */
    public $year;

    /**
     * @OA\Property(
     *      title="color",
     *      description="Color of the car",
     *      example="Red"
     * )
     *
     * @var string
     */
    public $color;

    /**
     * @OA\Property(
     *      title="registration_number",
     *      description="Registration number of the car",
     *      example="AB-123-CD"
     * )
     *
     * @var string
     */
    public $registration_number;

    /**
     * @OA\Property(
     *      title="mileage",
     *      description="Mileage of the car",
     *      example="50000"
     * )
     *
     * @var integer
     */
    public $mileage;

    /**
     * @OA\Property(
     *      title="daily_rate",
     *      description="Daily rate of the car",
     *      example="50.00"
     * )
     *
     * @var float
     */
    public $daily_rate;

    /**
     * @OA\Property(
     *      title="availability",
     *      description="Availability of the car",
     *      example="true"
     * )
     *
     * @var boolean
     */
    public $availability;

    /**
     * @OA\Property(
     *      title="image_path",
     *      description="Image path of the car",
     *      example="cars/clio.jpg"
     * )
     *
     * @var string
     */
    public $image_path;
}