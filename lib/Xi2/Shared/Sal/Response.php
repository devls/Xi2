<?php
/**
 * Xi2.
 * License: GPLv2/BSD
 * User: craigjbass
 * Date: 11/01/13
 * Time: 21:47
 */
namespace Xi2\Sal\Base;

class Response
{

    /* @var bool */
    private $status;

    /* @var array */
    private $data = [ 'data' => null, 'status' => null ];

    /**
     * Sets or Returns boolean transaction status. E.g. login success = true, login failure = false.
     *
     * @param bool $status
     * @throws \InvalidArgumentException
     * @return bool
     */
    public function status( $status = null )
    {
        if( !is_bool( $status ) ) {
            throw new \InvalidArgumentException( 'Argument 1 expects type bool.' );
        }

        if( $status !== null ) {
            $this->status = $status;
        }

        return $this->status;
    }

    /**
     * Returns or sets the data
     *
     * @param array $data
     * @return mixed
     */
    public function data( array $data = null )
    {
        if( !empty( $data ) ) {
            $this->data['data'] = $data;
        }

        return $this->data;

    }

    /**
     * Sets the info (code) that gets returned with data.
     *
     * @param $info
     */
    public function setInfo( $info )
    {
        $this->data['info'] = $info;
    }

}
