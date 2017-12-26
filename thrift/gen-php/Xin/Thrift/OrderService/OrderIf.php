<?php
namespace Xin\Thrift\OrderService;
/**
 * Autogenerated by Thrift Compiler (0.11.0)
 *
 * DO NOT EDIT UNLESS YOU ARE SURE THAT YOU KNOW WHAT YOU ARE DOING
 *  @generated
 */
use Thrift\Base\TBase;
use Thrift\Type\TType;
use Thrift\Type\TMessageType;
use Thrift\Exception\TException;
use Thrift\Exception\TProtocolException;
use Thrift\Protocol\TProtocol;
use Thrift\Protocol\TBinaryProtocolAccelerated;
use Thrift\Exception\TApplicationException;


interface OrderIf {
  /**
   * @return string
   * @throws \Xin\Thrift\OrderService\ThriftException
   */
  public function version();
  /**
   * @param int $userId
   * @param int $goodsId
   * @param int $shopId
   * @param int $num
   * @param int $unitFee
   * @return bool
   * @throws \Xin\Thrift\OrderService\ThriftException
   */
  public function addGoodsToCart($userId, $goodsId, $shopId, $num, $unitFee);
  /**
   * @param int $userId
   * @param int $pageSize
   * @param int $lastQueryId
   * @return \Xin\Thrift\OrderService\Order\CartList
   * @throws \Xin\Thrift\OrderService\ThriftException
   */
  public function listCartsByUserId($userId, $pageSize, $lastQueryId);
  /**
   * @param int $userId
   * @param int $goodsId
   * @param int $id
   * @return bool
   * @throws \Xin\Thrift\OrderService\ThriftException
   */
  public function delGoodsFromCart($userId, $goodsId, $id);
  /**
   * @param \Xin\Thrift\OrderService\Order\PlaceInput $input
   * @return int
   * @throws \Xin\Thrift\OrderService\ThriftException
   */
  public function place(\Xin\Thrift\OrderService\Order\PlaceInput $input);
  /**
   * @param int $userId
   * @param int $pageSize
   * @param int $lastQueryId
   * @return \Xin\Thrift\OrderService\Order\OrderList
   * @throws \Xin\Thrift\OrderService\ThriftException
   */
  public function listOrderByUserId($userId, $pageSize, $lastQueryId);
  /**
   * @param int $orderId
   * @return \Xin\Thrift\OrderService\Order\OrderInfo
   * @throws \Xin\Thrift\OrderService\ThriftException
   */
  public function getOrderInfo($orderId);
  /**
   * @param int $orderId
   * @return bool
   * @throws \Xin\Thrift\OrderService\ThriftException
   */
  public function paySuccess($orderId);
  /**
   * @param int $orderId
   * @return bool
   * @throws \Xin\Thrift\OrderService\ThriftException
   */
  public function delOrder($orderId);
}


