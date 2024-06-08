function updateDateTime() {
    const now = new Date();
    const formattedDateTime = now.toLocaleString();
    const dateTimeElement = document.getElementById('date-time');
    dateTimeElement.innerHTML = formattedDateTime;
  }
  
  setInterval(updateDateTime, 1000);
  