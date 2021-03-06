function toggle(event, className, type) {
  document.querySelectorAll(".button-select button").forEach((button) => {
    button.classList.remove(className);
  });

  const button = event.currentTarget;
  button.classList.add(className);

  const input = document.querySelector("[name=" + type + "]");

  input.value = button.dataset.value;
}