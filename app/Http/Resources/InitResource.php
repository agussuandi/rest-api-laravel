<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class InitResource extends JsonResource
{
    public static function collection($resource): array
    {
        $data = [
			'collection' => parent::collection($resource),
			'pagination' => []
		];

        if ($resource instanceof LengthAwarePaginator) {
			$data['pagination'] = [
				'total'         => $resource->count(),
                'perPage'       => $resource->perPage(),
                'currentPage'   => $resource->currentPage(),
                'firstPage'     => 1,
                'firstPageUrl'  => $resource->url(1),
                'lastPage'      => $resource->lastPage(),
                'lastPageUrl'   => $resource->url($resource->lastPage()),
                'nextPageUrl'   => $resource->nextPageUrl(),
                'prevPageUrl'   => $resource->previousPageUrl(),
                'totalData'     => $resource->total(),
			];
		}
        else {
            unset($data['pagination']);
        }
        return $data;
    }

    public function toArray($request): array
    {
        return parent::toArray($request);
    }
}
