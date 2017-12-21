namespace php Xin.Thrift.OrderService.Order

struct Order {
    1: i64 id,
    2: i64 userId,
    3: i64 orderId,
    4: i64 goodsId,
    5: i8 isDeleted
}

struct OrderList {
    1: list<Order> items
}