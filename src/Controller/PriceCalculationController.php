<?php

namespace App\Controller;

use App\DTO\Request\PriceCalculationRequest;
use App\DTO\Response\ErrorResponse;
use App\DTO\Response\PriceCalculationResponse;
use App\Exception\InvalidCouponException;
use App\Exception\InvalidTaxNumberException;
use App\Model\PriceCalculationModel;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class PriceCalculationController extends AbstractController
{

    public function __construct(
        private PriceCalculationModel $model
    ){}

    #[Route('/calculate-price', name: 'price_calculation', methods: ['POST'])]
    public function calculatePrice(
        #[MapRequestPayload] PriceCalculationRequest $request,
    ): Response
    {
        try{
            $response = new PriceCalculationResponse($this->model->calculatePrice($request));
        } catch (InvalidCouponException | InvalidTaxNumberException $e) {
            $response = new ErrorResponse(Response::HTTP_BAD_REQUEST, $e->getMessage());
        } catch (Exception $e) {
            $response = new ErrorResponse(Response::HTTP_INTERNAL_SERVER_ERROR, $e->getMessage());
        }

        return $this->json($response, $response->code);
    }
}
