<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Http\Requests\StoreRentalRequest;
use App\Http\Requests\UpdateRentalRequest;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Tag(
 *     name="Rentals",
 *     description="Operations related to rentals"
 * )
 */
class RentalController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/rentals",
     *      operationId="getRentalsList",
     *      tags={"Rentals"},
     *      summary="Get list of rentals",
     *      description="Returns list of rentals",
     *    @OA\Parameter(
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
        $query = Rental::query();

        // Apply filters based on request parameters
        if ($request->has('user_id')) {
            $query->where('user_id', $request->input('user_id'));
        }

        if ($request->has('car_id')) {
            $query->where('car_id', $request->input('car_id'));
        }

        if ($request->has('status')) {
            $query->where('status', $request->input('status'));
        }

        $rentals = $query->paginate(10);
        return response()->json($rentals);
    }

    /**
     * @OA\Post(
     *      path="/api/rentals",
     *      operationId="createRental",
     *      tags={"Rentals"},
     *      summary="Create a new rental",
     *      description="Creates a new rental in the database",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreRentalRequest")
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
    public function store(StoreRentalRequest $request)
    {
        $rental = Rental::create($request->validated());
        return response()->json($rental, 201);
    }

    /**
     * @OA\Get(
     *      path="/api/rentals/{id}",
     *      operationId="getRentalById",
     *      tags={"Rentals"},
     *      summary="Get rental information",
     *      description="Returns rental data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Rental id",
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
        $rental = Rental::find($id);
        if (!$rental) {
            return response()->json(['message' => 'Rental not found'], 404);
        }
        return response()->json($rental);
    }

     /**
     * @OA\Put(
     *      path="/api/rentals/{id}",
     *      operationId="updateRental",
     *      tags={"Rentals"},
     *      summary="Update existing Rental",
     *      description="Updates an existing Rental in the database",
     *      @OA\Parameter(
     *          name="id",
     *          description="Rental id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateRentalRequest")
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
    public function update(UpdateRentalRequest $request, string $id)
    {
        $rental = Rental::find($id);
        if (!$rental) {
            return response()->json(['message' => 'Rental not found'], 404);
        }
        $rental->update($request->validated());
        return response()->json($rental);
    }

     /**
     * @OA\Delete(
     *      path="/api/rentals/{id}",
     *      operationId="deleteRental",
     *      tags={"Rentals"},
     *      summary="Delete existing Rental",
     *      description="Deletes an existing Rental in the database",
     *      @OA\Parameter(
     *          name="id",
     *          description="Rental id",
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
        $rental = Rental::find($id);
        if (!$rental) {
            return response()->json(['message' => 'Rental not found'], 404);
        }
        $rental->delete();
        return response()->json(['message' => 'Rental deleted']);
    }
}