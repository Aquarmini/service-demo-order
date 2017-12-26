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
    4: list<cart.Cart> carts,
    5: string remark,
    6: i8 isDeleted
}

struct OrderList {
    1: list<Order> items
}

struct PlaceInput {
    1: i64 userId,
    2: list<i64> cartIds,
    3: string remark,
}