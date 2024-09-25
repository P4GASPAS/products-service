<?php

namespace App\Filter\V1;

use App\Filter\ApiFilter;

class ProductFilter extends ApiFilter {

    protected $safeParms = [
        'id' => ['eq', 'gt', 'lt', 'gte', 'lte', 'ne'],
        'name' => ['eq'],
        'description' => ['eq'],
        'brand' => ['eq'],
        'type' => ['eq'],
        'price' => ['eq', 'gt', 'lt', 'gte', 'lte', 'ne'],
        'stockQuantity' => ['eq', 'gt', 'lt', 'gte', 'lte', 'ne']
    ];

    protected $columnMap = [
        'stockQuantity' => 'stock_quantity'
    ];

    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
        'ne' => '!='
    ];

}