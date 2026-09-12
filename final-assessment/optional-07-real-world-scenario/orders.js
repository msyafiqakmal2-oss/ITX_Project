js
const orders = [];

function addOrder(id, customerName, items, status) {
  const order = { id, customerName, items, status };
  orders.push(order);
  return order;
}

function updateOrderStatus(id, newStatus) {
  const order = orders.find((order) => order.id === id);
  if (order) {
    order.status = newStatus;
  }
  return order;
}

function calculateTotalRevenue() {
  return orders
    .filter((order) => order.status === 'Selesai')
    .reduce((total, order) => {
      const orderTotal = order.items.reduce(
        (sum, item) => sum + item.price * item.quantity,
        0
      );
      return total + orderTotal;
    }, 0);
}

function deleteOrder(id) {
  const index = orders.findIndex((order) => order.id === id);
  if (index !== -1) {
    orders.splice(index, 1);
  }
}

export { orders, addOrder, updateOrderStatus, calculateTotalRevenue, deleteOrder };
