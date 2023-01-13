document.querySelectorAll(".delete-btn").forEach((button) => {
  button.addEventListener("click", (e) => {
    const clickedYes = confirm("Are you sure you want to delete?");
    if (!clickedYes) {
      e.preventDefault();
    }
  });
});
