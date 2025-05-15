document.addEventListener("DOMContentLoaded", () => {
  const calendar = document.getElementById("calendar");


  fetch("../PHP/order_dates.php")
    .then(res => res.json())
    .then(orderDates => {
      const today = new Date();
      const year = today.getFullYear();
      const month = today.getMonth(); 

      const firstDay = new Date(year, month, 1).getDay();
      const daysInMonth = new Date(year, month + 1, 0).getDate();

      
      for (let i = 0; i < firstDay; i++) {
        const empty = document.createElement("div");
        empty.className = "calendar-day";
        calendar.appendChild(empty);
      }

      for (let day = 1; day <= daysInMonth; day++) {
        const dateStr = `${year}-${String(month + 1).padStart(2, "0")}-${String(day).padStart(2, "0")}`;

        const dayDiv = document.createElement("div");
        dayDiv.className = "calendar-day";
        dayDiv.textContent = day;

        if (orderDates.includes(dateStr)) {
          dayDiv.classList.add("has-order");
        }

        if (
          day === today.getDate() &&
          month === today.getMonth() &&
          year === today.getFullYear()
        ) {
          dayDiv.classList.add("today");
        }

        calendar.appendChild(dayDiv);
      }
    })
    .catch(err => {
      calendar.textContent = "wuh oh no calendaw :3c .";
      console.error(err);
    });
});