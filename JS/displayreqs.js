document.addEventListener('DOMContentLoaded', () => {
  const container = document.getElementById("order-container");
  const pendingTab = document.getElementById("tab-pending");
  const completedTab = document.getElementById("tab-completed");
  const cancelledTab = document.getElementById("tab-cancelled");

  let allOrders = [];

  function renderOrders(statusFilter) {
    container.innerHTML = "";

    const filtered = allOrders.filter(order => order.status === statusFilter);

    filtered.forEach((order) => {
      const orderDiv = document.createElement("div");
      orderDiv.className = "order";

      const header = document.createElement("h3");
      header.textContent = `Order #${order.order_id}`;

      const name = document.createElement("p");
      name.textContent = `Name: ${order.customer_name}`;

      const phone = document.createElement("p");
      phone.textContent = `Contact: ${order.customer_phone}`;

      const date = document.createElement("p");
      date.textContent = `Date: ${new Date(order.order_date).toLocaleString()}`;

      const statusLabel = document.createElement("label");
      statusLabel.textContent = "Status: ";

      const statusSelect = document.createElement("select");
      ["pending", "completed", "cancelled"].forEach(status => {
        const option = document.createElement("option");
        option.value = status;
        option.textContent = status.charAt(0).toUpperCase() + status.slice(1);
        if (order.status === status) {
          option.selected = true;
        }
        statusSelect.appendChild(option);
      });

      statusSelect.addEventListener("change", () => {
        const newStatus = statusSelect.value;

        fetch(`/PHP/update_status.php`, {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify({
            order_id: order.order_id,
            status: newStatus
          })
        })
        .then(res => res.json())
        .then(data => {
          order.status = newStatus;
          renderOrders(statusFilter); // re-render current tab
        })
        .catch(err => console.error("Failed to update:", err));
      });

      statusLabel.appendChild(statusSelect);

      const itemList = document.createElement("ul");
      order.items.forEach((item) => {
        const itemEl = document.createElement("li");
        itemEl.textContent = `${item.dish_name} × ${item.quantity}`;
        itemList.appendChild(itemEl);
      });

      orderDiv.appendChild(header);
      orderDiv.appendChild(name);
      orderDiv.appendChild(phone);
      orderDiv.appendChild(date);
      orderDiv.appendChild(itemList);
      orderDiv.appendChild(statusLabel);

      container.appendChild(orderDiv);
    });
  }

  fetch("../PHP/api.php")
    .then(res => res.json())
    .then(data => {
      allOrders = data;
      renderOrders("pending");
    });

  pendingTab.addEventListener("click", () => renderOrders("pending"));
  completedTab.addEventListener("click", () => renderOrders("completed"));
  cancelledTab.addEventListener("click", () => renderOrders("cancelled"));
});
