document.addEventListener('DOMContentLoaded', () => {
const container = document.getElementById("order-container");
  const pendingTab = document.getElementById("tab-pending");
  const completedTab = document.getElementById("tab-completed");

  let allOrders = [];

  function renderOrders(statusFilter) {
    container.innerHTML = "";

    const filtered = allOrders.filter(order => order.status === statusFilter);

    filtered.forEach((order) => {
      const orderDiv = document.createElement("div");
      orderDiv.className = "order";

      const header = document.createElement("h3");
      header.textContent = `Order #${order.order_id}`;

      const phone = document.createElement("p");
      phone.textContent = `Customer Phone #: ${order.customer_phone}`;

      const date = document.createElement("p");
      date.textContent = `Date: ${new Date(order.order_date).toLocaleString()}`;

      const statusLabel = document.createElement("label");
      statusLabel.textContent = "Completed: ";

      const statusCheckbox = document.createElement("input");
      statusCheckbox.type = "checkbox";
      statusCheckbox.checked = order.status === "completed";

      statusCheckbox.addEventListener("change", () => {
        const newStatus = statusCheckbox.checked ? "completed" : "pending";

        fetch(`../PHP/update_status.php`, {
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
          renderOrders(statusFilter); 
        })
        .catch(err => console.error("Failed to update:", err));
      });

      statusLabel.appendChild(statusCheckbox);

      const itemList = document.createElement("ul");
      order.items.forEach((item) => {
        const itemEl = document.createElement("li");
        itemEl.textContent = `${item.dish_name} * ${item.quantity}`;
        itemList.appendChild(itemEl);
      });

      orderDiv.appendChild(header);
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
});