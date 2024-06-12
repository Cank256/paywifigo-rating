document.addEventListener("DOMContentLoaded", function () {
  const editIcons = document.querySelectorAll(".list-item .edit-icon");
  const saveButtons = document.querySelectorAll(".list-item .save");

  function updatePlanCost(id, planCost, priceElem, elemId) {
    $.ajax({
      url: "SalesDashboard/update_billing_plans.php",
      method: "POST",
      data: {id, planCost},
      success: function(data) {
        $(`#${elemId}`).find(".veeam-total").data("price", planCost);
        priceElem.text(planCost);
        console.log(data)
      },
      error: function(jqXHR) {
        console.log(jqXHR.responseText);
      }
    })
  }

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

  for (const editIcon of editIcons) {
    editIcon.addEventListener("click", switchToEdit);
  }

  for (const saveButton of saveButtons) {
    saveButton.addEventListener("click", switchToEdit);
  }


  $(".list-item").each(function(_, elem) {
    const elemId = $(elem).data("id");
    const idNum = $(elem).data("id_num");

    $(`#${elemId} > .hidden_section .quantity-up`).on("click", function() {
      const inputParent = $(this).parents(`#${elemId}`)[0];
      const input = $(inputParent).find(".quantity-input");
      const inputValue = parseInt(input.val());
      const price = parseInt($(inputParent).find(".veeam-total").data("price"));
      const infoElem = $(inputParent).find(".veeam-footnote");
      const priceElem = $(inputParent).find(".price__cont");

      if (inputValue < price) {
        const calcPrice = inputValue + 1;

        input.val(calcPrice);
        priceElem.text(`${calcPrice}`);
        infoElem.addClass("hidden");
      } else {
        infoElem.removeClass("hidden");
      }
    })

    $(`#${elemId} .hidden_section .quantity-down`).on("click", function() {
      const inputParent = $(this).parents(`#${elemId}`)[0];
      const input = $(inputParent).find(".quantity-input");
      const inputValue = parseInt(input.val());
      const priceElem = $(inputParent).find(".price__cont");
      const infoElem = $(inputParent).find(".veeam-footnote");

      if (inputValue > 0) {
        const calcPrice = inputValue - 1;

        input.val(calcPrice);
        priceElem.text(`${calcPrice}`);
        infoElem.addClass("hidden");
      } else {
        infoElem.removeClass("hidden");
      }
    })

    $(`#${elemId} .hidden_section .quantity-input`).on("change", function() {
      const inputParent = $(this).parents(`#${elemId}`)[0];
      const input = $(inputParent).find(".quantity-input");
      let inputValue = parseInt(input.val());
      const price = parseInt($(inputParent).find(".veeam-total").data("price"));
      const priceElem = $(inputParent).find(".price__cont");
      const infoElem = $(inputParent).find(".veeam-footnote");

      if (inputValue && !(inputValue >= 0 && inputValue <= price)) {
        inputValue = price;
        infoElem.removeClass("hidden")
      } else {
        infoElem.addClass("hidden")
      }

      if (inputValue) {
        input.val(inputValue);
        priceElem.text(`${inputValue}`);
      }
    })

    $(`#${elemId} .hidden_section .save`).on("click", function() {
      const inputParent = $(this).parents(`#${elemId}`)[0];
      const updatePrice = $(inputParent).find(".currency_price");
      const priceElem = $(inputParent).find(".price__cont");
      updatePlanCost(idNum, parseInt(priceElem.text()), updatePrice, elemId);
    })
  })
});


