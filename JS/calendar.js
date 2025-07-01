document.addEventListener("DOMContentLoaded", () => {
  const calendar = document.getElementById("calendar");

  const header = document.createElement("div");
  header.style.display = "flex";
  header.style.justifyContent = "center";
  header.style.alignItems = "center";
  header.style.gap = "1rem";
  header.style.marginBottom = "1rem";

  const prevBtn = document.createElement("button");
  prevBtn.textContent = "<";
  const nextBtn = document.createElement("button");
  nextBtn.textContent = ">";

  const monthLabel = document.createElement("h2");
  const monthNames = [
    "January", "February", "March", "April", "May", "June",
    "July", "August", "September", "October", "November", "December"
  ];

  header.appendChild(prevBtn);
  header.appendChild(monthLabel);
  header.appendChild(nextBtn);
  calendar.before(header); 

  let currentYear = new Date().getFullYear();
  let currentMonth = new Date().getMonth();

  function renderCalendar(orderDates) {
    calendar.innerHTML = ""; 

    monthLabel.textContent = `${monthNames[currentMonth]} ${currentYear}`;

    const today = new Date();
    const firstDay = new Date(currentYear, currentMonth, 1).getDay();
    const daysInMonth = new Date(currentYear, currentMonth + 1, 0).getDate();

    for (let i = 0; i < firstDay; i++) {
      const empty = document.createElement("div");
      empty.className = "calendar-day";
      calendar.appendChild(empty);
    }

    for (let day = 1; day <= daysInMonth; day++) {
      const dateStr = `${currentYear}-${String(currentMonth + 1).padStart(2, "0")}-${String(day).padStart(2, "0")}`;

      const dayDiv = document.createElement("div");
      dayDiv.className = "calendar-day";
      dayDiv.textContent = day;

      const isPending = orderDates.some(
        order => order.date === dateStr && order.status === "pending"
      );

      if (isPending) {
        dayDiv.classList.add("has-order");
      }

      if (
        day === today.getDate() &&
        currentMonth === today.getMonth() &&
        currentYear === today.getFullYear()
      ) {
        dayDiv.classList.add("today");
      }

      calendar.appendChild(dayDiv);
    }
  }

  function loadAndRenderCalendar() {
    fetch("../PHP/order_dates.php")
      .then(res => res.json())
      .then(orderDates => {
        renderCalendar(orderDates);
      })
      .catch(err => {
        calendar.textContent = "wuh oh no calendaw :3c .";
        console.error(err);
      });
  }

  prevBtn.addEventListener("click", () => {
    currentMonth--;
    if (currentMonth < 0) {
      currentMonth = 11;
      currentYear--;
    }
    loadAndRenderCalendar();
  });

  nextBtn.addEventListener("click", () => {
    currentMonth++;
    if (currentMonth > 11) {
      currentMonth = 0;
      currentYear++;
    }
    loadAndRenderCalendar();
  });

  // Initial load
  loadAndRenderCalendar();
});
