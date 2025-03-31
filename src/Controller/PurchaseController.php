<?php

namespace App\Controller;

use App\DTO\Request\PurchaseRequest;
use App\Exception\InvalidCouponException;
use App\Exception\InvalidTaxNumberException;
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
            return $this->json([
                'code' => Response::HTTP_OK,
                'message' => 'Purchase has been handled successfully'
            ], Response::HTTP_OK);
        } catch (InvalidCouponException | InvalidTaxNumberException  $e) {
            return $this->json([
                'code' => Response::HTTP_BAD_REQUEST,
                'error' => [
                    'message' => $e->getMessage()
                ]
            ], Response::HTTP_BAD_REQUEST);
        } catch (\Exception $e) {
            return $this->json([
                'code' => Response::HTTP_INTERNAL_SERVER_ERROR,
                'error' => [
                    'message' => $e->getMessage()
                ]
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
