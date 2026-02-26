// let swipeBuffer = '';
// let swipeTimeout = null;
// const swipeInput = document.getElementById('card-swipe-input');

// if (swipeInput) {
//     swipeInput.addEventListener('keydown', function (e) {
//         // Prevent visible input
//         e.preventDefault();

//         if (swipeTimeout) clearTimeout(swipeTimeout);

//         if (e.key !== 'Enter') {
//             swipeBuffer += e.key;
//         } else {
//             const cardId = swipeBuffer.trim();
//             swipeBuffer = '';

//             document.getElementById('card-display').textContent = `Card Assigned: ${cardId}`;
//             document.getElementById('card_id').value = cardId;

//             this.value = '';
//         }

//         swipeTimeout = setTimeout(() => swipeBuffer = '', 1000);
//     });
// }

let swipeBuffer = "";
let swipeTimeout = null;
const swipeInput = document.getElementById("card-swipe-input");

if (swipeInput) {
  swipeInput.addEventListener("keydown", function (e) {
    // Prevent visible input
    // e.preventDefault();

    if (swipeTimeout) clearTimeout(swipeTimeout);

    if (e.key !== "Enter") {
      swipeBuffer += e.key;
    } else {
      const cardId = swipeBuffer.trim();
      swipeBuffer = "";

      document.getElementById("card-display").textContent =
        `Card Assigned: ${cardId}`;
      document.getElementById("card_id").value = cardId;

      this.value = "";
    }

    swipeTimeout = setTimeout(() => (swipeBuffer = ""), 1000);
  });

  swipeInput.addEventListener("input", function (e) {
    document.getElementById("card_id").value = swipeInput.value.trim();
  });

  swipeInput.addEventListener("focus", function () {
    swipeInput.type = "text";
    swipeInput.value = "";
    document.getElementById("card_id").value = "";
  });

  swipeInput.addEventListener("blur", function () {
    swipeInput.type = "password";
  });
}
