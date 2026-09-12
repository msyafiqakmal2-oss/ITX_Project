let nextId = 1;

const orders = [];

function addOrder(customerName, items) {
  const totalPrice = items.reduce((sum, item) => sum + item.price, 0);

  const order = {
    id: `_someUniqueId${nextId}`,
    customerName,
    items,
    totalPrice,
    status: 'Menunggu',
  };

  nextId += 1;
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
    .reduce((total, order) => total + order.totalPrice, 0);
}

function deleteOrder(id) {
  const index = orders.findIndex((order) => order.id === id);
  if (index !== -1) {
    orders.splice(index, 1);
  }
}

// Jangan hapus kode di bawah ini!
export { orders, addOrder, updateOrderStatus, calculateTotalRevenue, deleteOrder };