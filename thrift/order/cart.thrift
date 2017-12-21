namespace php Xin.Thrift.OrderService.Order

struct Cart {
    1: i64 id,
    2: i64 userId,
    3: i64 shopId,
    4: i64 orderId,
    5: i64 goodsId,
    6: i32 unitFee,
    7: i32 num,
    8: i8 isDeleted
}

struct CartList {
    1: list<Cart> items
}