document.addEventListener("DOMContentLoaded", function () {
  const editIcons = document.querySelectorAll(".list-item .edit-icon");
  const saveButtons = document.querySelectorAll(".list-item .save");
  const updateSliders = document.querySelectorAll(".list-item .update-slider");

  function switchToEdit(e) {
    e.preventDefault();
    e.stopPropagation();
    const elemContainer = this.parentElement.parentElement;

    if (elemContainer.classList.contains("list-item__inner")) {
      const hiddenElem = elemContainer.parentElement.querySelector(".hidden");

      elemContainer.classList.remove("list-item__inner");
      elemContainer.classList.add("hidden");

      if (hiddenElem) {
        hiddenElem.classList.remove("hidden");
        hiddenElem.classList.add("list-item__inner");
      }
    }
  }

  function updateValue(e) {
    const formContainer = this.parentElement.parentElement;
    const valueContainer = formContainer.querySelector(".price__value");

    if (valueContainer) {
      const sectionContainer = formContainer.parentElement.parentElement;

      valueContainer.innerHTML = ` <span class="large">$</span>&nbsp;${e.target.value}`;
      sectionContainer.querySelector(
        "section > aside .price__value"
      ).innerHTML = ` <span class="large">$</span>&nbsp;${e.target.value}`;
    }
  }
  for (const editIcon of editIcons) {
    editIcon.addEventListener("click", switchToEdit);
  }

  for (const saveButton of saveButtons) {
    saveButton.addEventListener("click", switchToEdit);
  }

  for (const updateSlider of updateSliders) {
    updateSlider.addEventListener("input", updateValue);
  }
});


jQuery('<div class="quantity-nav"><div class="quantity-button quantity-up"><i class="fa fa-plus"></i></div><div class="quantity-button quantity-down"><i class="fa fa-minus"></i></div></div>').insertAfter('.quantity input');

jQuery('.quantity').each(function() {

  var spinner = jQuery(this),
      input   = spinner.find('input[type="number"]'),
      btnUp   = spinner.find('.quantity-up'),
      btnDown = spinner.find('.quantity-down'),
      min     = input.attr('min'),
      max     = input.attr('max');

  btnUp.click(function() {
    var oldValue = parseFloat(input.val());
    if (oldValue >= max) {
      var newVal = oldValue;
      $('.limit-reached').show();
    } else {
      $('.limit-reached').hide();
      var newVal = oldValue + 1;
      calcPrice(newVal);
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });
  btnDown.click(function() {
    var oldValue = parseFloat(input.val());
    if (oldValue <= min) {
      var newVal = oldValue;
    } else {
      $('.limit-reached').hide();
      var newVal = oldValue - 1;
      calcPrice(newVal);
    }
    spinner.find("input").val(newVal);
    spinner.find("input").trigger("change");
  });

  input.change(function(){
    if(input.val() >= 100) { input.val(100); }
    if(input.val() <= 5) { input.val(5); }
    calcPrice(input.val());
  });

});

function currency(n, currency) {
  return "$" + n.toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,");
}

function calcPrice(servers) {

  var p = [20,17.5,15,12.5],
      el = $('span.veeam-price'),
      total;

  if (servers <= 9) { total = servers * p[0]; } else
  if (servers <= 25) { total = servers * p[1]; } else
  if (servers <= 49) { total = servers * p[2]; } else
  if (servers <= 99) { total = servers * p[3]; }
  if (servers >= 100) {
    $('.veeam-total').hide();
    $('.contact').fadeIn(200);
  }else {
    $('.contact').hide();
    $('.veeam-total').fadeIn(200);
    el.text(($('#annual_term').is(':checked') ? currency(total - (total * .1)) : currency(total)));
  }

}

jQuery(document).ready(function($){
  calcPrice(5);
  $('.radio input').change(function(){
    calcPrice($('#servers').val());
    if($('#annual_term').is(':checked')) {
      $('.annual-txt').fadeIn(200);
    }else {
      $('.annual-txt').fadeOut(200);
    }
  });
});