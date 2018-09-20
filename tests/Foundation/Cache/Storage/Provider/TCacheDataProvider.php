<?php
namespace Test\Foundation\Cache\Storage\Provider;

trait TCacheDataProvider
{

    /**
     * Provides data test.
     *
     * @return array List of tests and results
     */
    public function getCacheData()
    {
        return [
            [
                'label'  => 'Key is not valid',
                'input'  => [
                    'key'   => null,
                    'value' => 'the value',
                    'ttl'   => 0 ],
                'result' => [
                    'store'  => false,
                    'exists' => false,
                    'fetch'  => [
                        'return'  => false,
                        'success' => false ],
                    'delete' => false ] ],
            [
                'label'  => 'Key is empty',
                'input'  => [
                    'key'   => ' ',
                    'value' => 'the value',
                    'ttl'   => 0 ],
                'result' => [
                    'store'  => false,
                    'exists' => false,
                    'fetch'  => [
                        'return'  => false,
                        'success' => false ],
                    'delete' => false ] ],
            [
                'label'  => 'Key is not expired',
                'input'  => [
                    'key'   => 'keyisnotexpired',
                    'value' => 'the value',
                    'ttl'   => 0 ],
                'result' => [
                    'store'  => true,
                    'exists' => true,
                    'fetch'  => [
                        'return'  => 'the value',
                        'success' => true ],
                    'delete' => true ] ]
        ];
    }

    /**
     * Provides data ttl test.
     *
     * @return array List of tests and results
     */
    public function getCacheDataTtl()
    {
        return [
            [
                'label'  => 'Key is expired',
                'input'  => [
                    'key'   => 'keyisexpired',
                    'value' => 'the value',
                    'ttl'   => 5 ],
                'result' => [
                    'store'  => true,
                    'exists' => false,
                    'fetch'  => [
                        'return'  => false,
                        'success' => false ],
                    'delete' => false ] ]
        ];
    }

    /**
     * Provides unknow key test case.
     *
     * @return array List of tests and results
     */
    public function getCacheKeyDoesNotExist()
    {
        return [
            [
                'label'  => 'Key Does Not Exist',
                'input'  => [ 'key' => null ],
                'result' => [
                    'exists' => false,
                    'fetch'  => [
                        'return'  => false,
                        'success' => false ],
                    'delete' => false ] ],
        ];
    }
}
