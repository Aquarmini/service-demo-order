namespace php Xin.Thrift.OrderService

include "order/cart.thrift"

include "order/order.thrift"

exception ThriftException {
  1: i32 code,
  2: string message
}

service Order {
    // 返回项目版本号
    string version() throws (1:ThriftException ex)

    // 添加购物车
    bool addGoodsToCart(1:i64 userId, 2:i64 goodsId, 3:i64 shopId, 4:i32 num, 5:i32 unitFee) throws (1:ThriftException ex)

    // 获取购物车列表
    cart.CartList listCartsByUserId(1:i64 userId, 2:i32 pageSize, 3:i64 lastQueryId) throws (1:ThriftException ex)

    // 删除购物车中的商品
    bool delGoodsFromCart(1:i64 userId, 2:i64 goodsId, 3:i64 id) throws (1:ThriftException ex)

    // 下单接口
    i64 place(1:i64 userId, 2:list<i64> cartIds) throws (1:ThriftException ex)

    // 获取用户订单列表
    order.OrderList listOrderByUserId(1:i64 userId, 2:i32 pageSize, 3:i64 lastQueryId) throws (1:ThriftException ex)

    // 获取订单详情
    order.OrderInfo getOrderInfo(1:i64 orderId) throws (1:ThriftException ex)

}