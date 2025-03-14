<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Http\Requests\StoreCarRequest;
use App\Http\Requests\UpdateCarRequest;
use Illuminate\Http\Request;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="Car Rental API",
 *      description="API for managing car rentals",
 *      @OA\Contact(
 *          email="youremail@example.com"
 *      ),
 *      @OA\License(
 *          name="MIT",
 *          url="https://opensource.org/licenses/MIT"
 *      )
 * )
 *
 * @OA\Server(
 *      url=L5_SWAGGER_CONST_HOST,
 *      description="Car Rental API Server"
 * )

 * @OA\Tag(
 *     name="Cars",
 *     description="Operations related to cars"
 * )
 */
class CarController extends Controller
{
    /**
     * @OA\Get(
     *      path="/api/cars",
     *      operationId="getCarsList",
     *      tags={"Cars"},
     *      summary="Get list of cars",
     *      description="Returns list of cars",
     *      @OA\Parameter(
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
        $query = Car::query();

        // Apply filters based on request parameters
        if ($request->has('brand')) {
            $query->where('brand', 'like', '%' . $request->input('brand') . '%');
        }

        if ($request->has('model')) {
            $query->where('model', 'like', '%' . $request->input('model') . '%');
        }

        if ($request->has('year')) {
            $query->where('year', $request->input('year'));
        }

        if ($request->has('availability')) {
            $query->where('availability', $request->input('availability'));
        }

        $cars = $query->paginate(10); // Paginate the results, 10 items per page
        return response()->json($cars);
    }

    /**
     * @OA\Post(
     *      path="/api/cars",
     *      operationId="createCar",
     *      tags={"Cars"},
     *      summary="Create a new car",
     *      description="Creates a new car in the database",
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/StoreCarRequest")
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
    public function store(StoreCarRequest $request)
    {
        $car = Car::create($request->validated());
        return response()->json($car, 201);
    }

    /**
     * @OA\Get(
     *      path="/api/cars/{id}",
     *      operationId="getCarById",
     *      tags={"Cars"},
     *      summary="Get car information",
     *      description="Returns car data",
     *      @OA\Parameter(
     *          name="id",
     *          description="Car id",
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
        $car = Car::find($id);
        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }
        return response()->json($car);
    }

    /**
     * @OA\Put(
     *      path="/api/cars/{id}",
     *      operationId="updateCar",
     *      tags={"Cars"},
     *      summary="Update existing car",
     *      description="Updates an existing car in the database",
     *      @OA\Parameter(
     *          name="id",
     *          description="Car id",
     *          required=true,
     *          in="path",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *      ),
     *      @OA\RequestBody(
     *          required=true,
     *          @OA\JsonContent(ref="#/components/schemas/UpdateCarRequest")
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
    public function update(UpdateCarRequest $request, string $id)
    {
        $car = Car::find($id);
        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }
        $car->update($request->validated());
        return response()->json($car);
    }

    /**
     * @OA\Delete(
     *      path="/api/cars/{id}",
     *      operationId="deleteCar",
     *      tags={"Cars"},
     *      summary="Delete existing car",
     *      description="Deletes an existing car in the database",
     *      @OA\Parameter(
     *          name="id",
     *          description="Car id",
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
        $car = Car::find($id);
        if (!$car) {
            return response()->json(['message' => 'Car not found'], 404);
        }
        $car->delete();
        return response()->json(['message' => 'Car deleted']);
    }
}