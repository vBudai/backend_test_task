<?php

namespace App\Controller;

use App\DTO\Request\PurchaseRequest;
use App\DTO\Response\ErrorResponse;
use App\DTO\Response\SuccessResponse;
use App\Exception\InvalidCouponException;
use App\Exception\InvalidPaymentProcessor;
use App\Exception\InvalidTaxNumberException;
use App\Exception\PaymentProcessingException;
use App\Model\PurchaseModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Attribute\Route;

final class PurchaseController extends AbstractController
{

    public function __construct(
        protected PurchaseModel $model
    ){}

    #[Route('/purchase', name: 'purchase', methods: ['POST'])]
    public function purchase(
        #[MapRequestPayload(acceptFormat: 'json')] PurchaseRequest $request
    ): Response
    {
        try{
            $this->model->purchase($request);
            $response = new SuccessResponse(
                Response::HTTP_OK,
                'Purchase has been handled successfully'
            );
        } catch (InvalidCouponException | InvalidTaxNumberException | PaymentProcessingException | InvalidPaymentProcessor $e) {
            $response = new ErrorResponse(
                Response::HTTP_UNPROCESSABLE_ENTITY,
                $e->getMessage()
            );
        }
        catch (\Exception $e) {
            $response = new ErrorResponse(
                Response::HTTP_INTERNAL_SERVER_ERROR,
                $e->getMessage()
            );
        }

        return $this->json($response, $response->code);
    }
}
