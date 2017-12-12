namespace php Xin.Thrift.OrderService

include "order/cart.thrift"

exception ThriftException {
  1: i32 code,
  2: string message
}

service Order {
    // 返回项目版本号
    string version() throws (1:ThriftException ex)

    // 添加购物车
    bool addGoodsToCart(1:i64 userId, 2:i64 goodsId) throws (1:ThriftException ex)

    // 获取购物车列表
    cart.CartList listCartsByUserId(1:i64 userId, 2:i32 pageSize, 3:i64 lastQueryId) throws (1:ThriftException ex)

    // 删除购物车中的商品
    bool delGoodsFromCart(1:i64 userId, 2:i64 goodsId, 3:i64 id) throws (1:ThriftException ex)
}