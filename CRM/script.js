var input = document.querySelector("#phone");
var iti = window.intlTelInput(input, {
  initialCountry: "Ke",
  showSelectedDialCode: true,
  // separateDialCode:true,
  // utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.0/build/js/utils.js",
  utilsScript: "assets/utils.js",
});

// store the instance variable so we can access it in the console e.g. window.iti.getNumber()
window.iti = iti;
// input.value= iti;
// console.log(input.value);