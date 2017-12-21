namespace php Xin.Thrift.OrderService.Order

include "cart.thrift"

struct Order {
    1: i64 id,
    2: i64 userId,
    3: i32 totalFee,
    4: i8 isDeleted
}

struct OrderInfo {
    1: i64 id,
    2: i64 userId,
    3: i32 totalFee,
    4: cart.CartList carts,
    5: i8 isDeleted
}

struct OrderList {
    1: list<Order> items
}