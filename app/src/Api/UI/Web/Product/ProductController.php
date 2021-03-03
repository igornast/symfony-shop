<?php
declare(strict_types=1);

namespace App\Api\UI\Web\Product;

use App\Api\Application\Command\CreateProductCommand;
use App\Api\Application\Product\Dto\ProductCreateInput;
use App\Api\Application\Product\Dto\ProductListResponse;
use App\Api\Application\Serializer\AppSerializerInterface;
use App\Api\Domain\Product\ProductRepositoryInterface;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Webmozart\Assert\Assert;

/**
 * Class ProductController
 * @package App\Api\UI\Web\Product
 * @Route(path="/products")
 */
class ProductController extends AbstractController
{
    /**
     * @var AppSerializerInterface
     */
    private AppSerializerInterface $serializer;

    public function __construct(AppSerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @Route(name="api_product_get_list", methods={"GET"})
     * @SWG\Tag(name="Products")
     * @SWG\Response(
     *     response=200,
     *     description="Returns the list of products.",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type="App\Api\Application\Product\Dto\ProductListResponse", groups={"product_list"}))
     *     )
     * )
     * @SWG\Parameter(
     *     name="page",
     *     in="query",
     *     type="integer",
     *     required=true,
     *     description="Page number"
     * )
     */
    public function getListAction(Request $request, ProductRepositoryInterface $productRepository): JsonResponse
    {
        $page = $request->query->getInt('page', 1);
        Assert::greaterThan($page, 0, 'The page value must be a positive integer. Got: %s');

        $items = $productRepository->getForListWithPrice($page);
        $pageCount = $productRepository->getPageCount();

        $data = $this->serializer->normalize(ProductListResponse::create($items, $page, $pageCount),
            ['groups' => ['product_list']]);

        return new JsonResponse($data);
    }


    /**
     * @Route(name="api_product_create", methods={"POST"})
     * @SWG\Tag(name="Products")
     * @SWG\Response(response=201, description="Product resource created.")
     * @SWG\Response(response=400, description="Invalid data given.")
     * @SWG\Parameter(
     *     in="body",
     *     name="payload",
     *     @SWG\Schema(
     *         type="object",
     *         ref=@Model(type="App\Api\Application\Product\Dto\ProductCreateInput")
     *     )
     * )
     */
    public function createProductAction(Request $request, ValidatorInterface $validator, MessageBusInterface $bus): JsonResponse
    {
        /** @var ProductCreateInput $inputModel */
        $inputModel = $this->serializer->deserialize($request->getContent(), ProductCreateInput::class);
        $errors = $validator->validate($inputModel);

        if (count($errors) > 0) {
            $errorItems = [];

            /** @var ConstraintViolation $error */
            foreach ($errors as $error) {
                $errorItems[$error->getPropertyPath()][] = $error->getMessage();
            }

            return new JsonResponse($errorItems, Response::HTTP_BAD_REQUEST);
        }

        $bus->dispatch(CreateProductCommand::create(
            $inputModel->getName(),
            $inputModel->getDescription(),
            $inputModel->getAmount(),
            $inputModel->getCurrency(),
        ));
        return new JsonResponse(null, Response::HTTP_CREATED);
    }
}