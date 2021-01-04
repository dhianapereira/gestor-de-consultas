function toggleGenre(event) {
  document.querySelectorAll(".button-select button").forEach((button) => {
    button.classList.remove("active-genre");
  });

  const button = event.currentTarget;
  button.classList.add("active-genre");

  const input = document.querySelector('[name="genre"]');

  input.value = button.dataset.value;

  console.log(input.value)
}

function toggleNaturalness(event) {
  document.querySelectorAll(".button-select button").forEach((button) => {
    button.classList.remove("active-naturalness");
  });

  const button = event.currentTarget;
  button.classList.add("active-naturalness");

  const input = document.querySelector('[name="naturalness"]');

  input.value = button.dataset.value;

  console.log(input.value)
}

