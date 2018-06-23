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
                    'key'   => NULL,
                    'value' => 'the value',
                    'ttl'   => 0 ],
                'result' => [
                    'store'  => FALSE,
                    'exists' => FALSE,
                    'fetch'  => [
                        'return'  => FALSE,
                        'success' => FALSE ],
                    'delete' => FALSE ] ],
            [
                'label'  => 'Key is empty',
                'input'  => [
                    'key'   => ' ',
                    'value' => 'the value',
                    'ttl'   => 0 ],
                'result' => [
                    'store'  => FALSE,
                    'exists' => FALSE,
                    'fetch'  => [
                        'return'  => FALSE,
                        'success' => FALSE ],
                    'delete' => FALSE ] ],
            [
                'label'  => 'Key is not expired',
                'input'  => [
                    'key'   => 'keyisnotexpired',
                    'value' => 'the value',
                    'ttl'   => 0 ],
                'result' => [
                    'store'  => TRUE,
                    'exists' => TRUE,
                    'fetch'  => [
                        'return'  => 'the value',
                        'success' => TRUE ],
                    'delete' => TRUE ] ]
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
                    'store'  => TRUE,
                    'exists' => FALSE,
                    'fetch'  => [
                        'return'  => FALSE,
                        'success' => FALSE ],
                    'delete' => FALSE ] ]
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
                'input'  => [ 'key' => NULL ],
                'result' => [
                    'exists' => FALSE,
                    'fetch'  => [
                        'return'  => FALSE,
                        'success' => FALSE ],
                    'delete' => FALSE ] ],
        ];
    }

}