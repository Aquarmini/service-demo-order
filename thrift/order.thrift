namespace php Xin.Thrift.OrderService
namespace go vendor.order.service

exception ThriftException {
  1: i32 code,
  2: string message
}

service Order {
    // 返回项目版本号
    string version() throws (1:ThriftException ex)

    // 添加购物车
    bool addGoodsToCart(1:i64 userId, 2:i64 goodsId) throws (1:ThriftException ex)

    // 删除购物车中的商品
    bool delGoodsFromCart(1:i64 userId, 2:i64 goodsId, 3:i64 id) throws (1:ThriftException ex)
}