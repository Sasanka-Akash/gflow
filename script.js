function changeView() {
  var signUpBox = document.getElementById("signUpBox");
  var signInBox = document.getElementById("signInBox");

  signUpBox.classList.toggle("d-none");
  signInBox.classList.toggle("d-none");
}

function signUp() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var email = document.getElementById("email");
  var password = document.getElementById("password");
  var mobile = document.getElementById("mobile");
  var gender = document.getElementById("gender");

  var form = new FormData();

  form.append("f", fname.value);
  form.append("l", lname.value);
  form.append("e", email.value);
  form.append("p", password.value);
  form.append("m", mobile.value);
  form.append("g", gender.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      if (response == "Success") {
        document.getElementById("msg").innerHTML = "Registration Successfull";
        document.getElementById("msg").className = "alert alert-success";
        document.getElementById("msgdiv").className = "d-block";
      } else {
        document.getElementById("msg").innerHTML = response;
        document.getElementById("msgdiv").className = "d-block";
      }
    }
  };

  request.open("POST", "signUpProcess.php", true);
  request.send(form);
}

function signIn() {
  var email = document.getElementById("email2");
  var password = document.getElementById("password2");
  var rememberme = document.getElementById("rememberme");

  var form = new FormData();
  form.append("e", email.value);
  form.append("p", password.value);
  form.append("r", rememberme.checked);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      if (response == "success") {
        window.location = "home.php";
      } else {
        document.getElementById("msg1").innerHTML = response;
        document.getElementById("msgdiv1").className = "d-block";
      }
    }
  };

  request.open("POST", "signInProcess.php", true);
  request.send(form);
}

var forgotPasswordModal;

function fgpassword() {
  var email = document.getElementById("email2");

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var text = request.responseText;

      if (text == "Success") {
        showAlert(
          "Success",
          "Verification code has sent successfullty. Please check your Email.",
          "success"
        );
        // alert("Verification code has sent successfullty. Please check your Email.");
        var modal = document.getElementById("fpmodal");
        forgotPasswordModal = new bootstrap.Modal(modal);
        forgotPasswordModal.show();
      } else {
        document.getElementById("msg1").innerHTML = text;
        document.getElementById("msgdiv1").className = "d-block";
      }
    }
  };

  request.open("GET", "forgotPasswordProcess.php?e=" + email.value, true);
  request.send();
}

function showPassword1() {
  var textfield = document.getElementById("np");
  var button = document.getElementById("npb");

  if (textfield.type == "password") {
    textfield.type = "text";
    button.innerHTML = "Hide";
  } else {
    textfield.type = "password";
    button.innerHTML = "Show";
  }
}

function showPassword2() {
  var textfield = document.getElementById("rnp");
  var button = document.getElementById("rnpb");

  if (textfield.type == "password") {
    textfield.type = "text";
    button.innerHTML = "Hide";
  } else {
    textfield.type = "password";
    button.innerHTML = "Show";
  }
}
function resetPassword() {
  var email = document.getElementById("email2");
  var newPassword = document.getElementById("np");
  var retypePassword = document.getElementById("rnp");
  var verification = document.getElementById("vcode");

  var form = new FormData();

  form.append("e", email.value);
  form.append("n", newPassword.value);
  form.append("r", retypePassword.value);
  form.append("v", verification.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "success") {
        showAlert("Success", "Password Updated Successfully.", "success");
        // alert("Password Updated Successfully.");
        forgotPasswordModal.hide();
      } else {
        showAlert("Error", response, "error");
      }
    }
  };

  request.open("POST", "resetPasswordProcess.php", true);
  request.send(form);
}

function signout() {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "success") {
        showAlert("Success", "Sign Out", "success").then(() => {
          window.location.reload();
        });
      }
    }
  };

  request.open("GET", "signOutProcess.php", true);
  request.send();
}

function changeProfileImg() {
  var img = document.getElementById("profileimage");

  img.onchange = function () {
    //anonimas function
    var file = this.files[0];
    var url = window.URL.createObjectURL(file);

    document.getElementById("img").src = url;
  };
}

function updateProfile() {
  var fname = document.getElementById("fname");
  var lname = document.getElementById("lname");
  var mobile = document.getElementById("mobile");
  var line1 = document.getElementById("line1");
  var line2 = document.getElementById("line2");
  var province = document.getElementById("province");
  var district = document.getElementById("district");
  var city = document.getElementById("city");
  var pcode = document.getElementById("pcode");
  var image = document.getElementById("profileimage");

  var form = new FormData();

  form.append("f", fname.value);
  form.append("l", lname.value);
  form.append("m", mobile.value);
  form.append("l1", line1.value);
  form.append("l2", line2.value);
  form.append("p", province.value);
  form.append("d", district.value);
  form.append("c", city.value);
  form.append("pc", pcode.value);
  form.append("i", image.files[0]);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      if (response == "Updated" || response == "Saved") {
        window.location.reload();
      } else if (
        response ==
        showAlert("Error", "You have not selected any image.", "error")
      ) {
        // alert("You have not selected any image.");
      } else {
        showAlert("Error", response, "error");
      }
    }
  };

  request.open("POST", "updateProfileProcess.php", true);
  request.send(form);
}

function UshowPassword() {
  var textfield = document.getElementById("ps");
  var button = document.getElementById("ph");

  if (textfield.type == "password") {
    textfield.type = "text";
  } else {
    textfield.type = "password";
  }
}

function addProduct() {
  var category = document.getElementById("category");
  var brand = document.getElementById("brand");
  var model = document.getElementById("model");
  var title = document.getElementById("title");
  var condition = 0;

  if (document.getElementById("b").checked) {
    condition = 1;
  } else if (document.getElementById("u").checked) {
    condition = 2;
  }

  var qty = document.getElementById("qty");
  var cost = document.getElementById("cost");
  var dwc = document.getElementById("dwc");
  var doc = document.getElementById("doc");
  var desc = document.getElementById("desc");
  var image = document.getElementById("imageuploader");

  var form = new FormData();

  form.append("ca", category.value);
  form.append("b", brand.value);
  form.append("m", model.value);
  form.append("t", title.value);
  form.append("con", condition);

  form.append("q", qty.value);
  form.append("co", cost.value);
  form.append("dwc", dwc.value);
  form.append("doc", doc.value);
  form.append("de", desc.value);

  var file_count = image.files.length;

  for (var x = 0; x < file_count; x++) {
    form.append("image" + x, image.files[x]);
  }

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      if (response == "success") {
        window.location = "manageProducts.php";
      } else {
        alert(response);
      }
    }
  };
  request.open("POST", "addProductProcess.php", true);
  request.send(form);
}

function changeProductImage() {
  var image = document.getElementById("imageuploader");

  image.onchange = function () {
    var file_count = image.files.length;

    if (file_count <= 3) {
      for (var x = 0; x < file_count; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);

        document.getElementById("i" + x).src = url;
      }
    } else {
      alert(
        file_count +
          "files. You are proceed to upload only 3 or less than 3 files."
      );
    }
  };
}

function changeStatus(id) {
  var product_id = id;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "Deactivated" || response == "Activated") {
        window.location.reload();
      } else {
        alert(response);
      }
    }
  };

  request.open("GET", "changeStatusProcess.php?id=" + product_id, true);
  request.send();
}

function sort1(x) {
  var search = document.getElementById("s");

  var time = "0";

  if (document.getElementById("n").checked) {
    time = "1";
  } else if (document.getElementById("o").checked) {
    time = "2";
  }

  var qty = "0";

  if (document.getElementById("h").checked) {
    qty = "1";
  } else if (document.getElementById("l").checked) {
    qty = "2";
  }

  var condition = "0";

  if (document.getElementById("b").checked) {
    condition = "1";
  } else if (document.getElementById("u").checked) {
    condition = "2";
  }

  var brand = "0";

  if (document.getElementById("r").checked) {
    brand = "1";
  } else if (document.getElementById("m").checked) {
    brand = "2";
  } else if (document.getElementById("a").checked) {
    brand = "3";
  } else if (document.getElementById("le").checked) {
    brand = "4";
  }

  var category = "0";

  if (document.getElementById("lp").checked) {
    category = "1";
  } else if (document.getElementById("cb").checked) {
    category = "2";
  } else if (document.getElementById("cp").checked) {
    category = "3";
  } else if (document.getElementById("pt").checked) {
    category = "4";
  }

  // var gpu = "0";

  // if(document.getElementById("gp1").checked){
  //     gpu = "1";
  // }else if(document.getElementById("gp2").checked){
  //     gpu = "2";
  // }else if(document.getElementById("gp3").checked){
  //     gpu = "3";
  // }else if(document.getElementById("gp4").checked){
  //     gpu = "4";
  // }else if(document.getElementById("gp5").checked){
  //     gpu = "5";
  // }else if(document.getElementById("gp6").checked){
  //     gpu = "6";
  // }

  var form = new FormData();
  form.append("s", search.value);
  form.append("t", time);
  form.append("q", qty);
  form.append("c", condition);
  form.append("b", brand);
  form.append("ca", category);
  // form.append("gpu",gpu);
  form.append("page", x);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      document.getElementById("sort").innerHTML = response;
    }
  };

  request.open("POST", "sortProcess.php", true);
  request.send(form);
}

function clearSort() {
  window.location.reload();
}

function sendid(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;

      if (response == "Success") {
        window.location = "updateProduct.php";
      } else {
        alert(response);
      }
    }
  };

  request.open("GET", "sendIdProcess.php?id=" + id, true);
  request.send();
}

function updateProduct() {
  var title = document.getElementById("t");
  var qty = document.getElementById("q");
  var dwc = document.getElementById("dwc");
  var doc = document.getElementById("doc");
  var description = document.getElementById("d");
  var images = document.getElementById("imageuploader");

  var form = new FormData();

  form.append("t", title.value);
  form.append("q", qty.value);
  form.append("dwc", dwc.value);
  form.append("doc", doc.value);
  form.append("d", description.value);

  var file_count = images.files.length;

  for (var x = 0; x < file_count; x++) {
    form.append("i" + x, images.files[x]);
  }

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;
      if (response == "Product has been Updated.") {
        window.location = "manageProducts.php";
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "updateProductProcess.php", true);
  request.send(form);
}

function basicSearch(x) {
  var text = document.getElementById("basic_txt");
  var select = document.getElementById("basic_search_select");

  var form = new FormData();
  form.append("t", text.value);
  form.append("s", select.value);
  form.append("page", x);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;
      document.getElementById("basicSearchResult").innerHTML = response;
    }
  };

  request.open("POST", "basicSearchProcess.php", true);
  request.send(form);
}

function advancedSearch(x) {
  var txt = document.getElementById("t");
  var category = document.getElementById("c1");
  var brand = document.getElementById("b1");
  var model = document.getElementById("m");
  var condition = document.getElementById("c2");
  var color = document.getElementById("c3");
  var from = document.getElementById("pf");
  var to = document.getElementById("pt");
  var sort = document.getElementById("s");

  var form = new FormData();

  form.append("t", txt.value);
  form.append("cat", category.value);
  form.append("b", brand.value);
  form.append("m", model.value);
  form.append("con", condition.value);
  form.append("col", color.value);
  form.append("pf", from.value);
  form.append("pt", to.value);
  form.append("s", sort.value);
  form.append("page", x);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;
      document.getElementById("view_area").innerHTML = response;
    }
  };

  request.open("POST", "advancedSearchProcess.php", true);
  request.send(form);
}

function loadMainImg(id) {
  var sample_img = document.getElementById("productImg" + id).src;
  var main_img = document.getElementById("mainImg");

  main_img.style.backgroundImage = "url(" + sample_img + ")";
}

function check_value(qty) {
  var input = document.getElementById("qty_input");

  if (input.value <= 0) {
    alert("Quantity must be 01 or more.");
    input.value = 1;
  } else if (input.value > qty) {
    alert("Insufficient Quantity.");
    input.value = qty;
  }
}

function qty_inc(qty) {
  var input = document.getElementById("qty_input");

  if (input.value < qty) {
    var newValue = parseInt(input.value) + 1; //ekt vad vadinm ekhthu
    input.value = newValue;
  } else {
    showAlert("Warning", "Maximum Quantity has Achieved.", "warning");
    // alert("Maximum Quantity has Achieved.");
    input.value = 1;
  }
}

function qty_dec() {
  var input = document.getElementById("qty_input");

  if (input.value > 1) {
    var newValue = parseInt(input.value) - 1; //ekt vad vadinm adu
    input.value = newValue;
  } else {
    showAlert("Warning", "Minimum Quantity has Achieved.", "warning");
    // alert("Minimum Quantity has Achieved.");
    input.value = 1;
  }
}
function addToWatchlist(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      if (response == "added") {
        document.getElementById("heart" + id).style.className = "text-danger";
        window.location.reload();
      } else if (response == "removed") {
        document.getElementById("heart" + id).style.className = "text-dark";
        window.location.reload();
      } else {
        alert(response);
      }
    }
  };

  request.open("GET", "addToWatchlistProcess.php?id=" + id, true);
  request.send();
}

function removeFromWatchlist(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "success") {
        showAlert("Success", "Remove From Watchlist", "success").then(() => {
          window.location.reload();
        });
      } else {
        showAlert("Error", response, "error");
      }
    }
  };

  request.open("GET", "removeWatchlistProcess.php?id=" + id, true);
  request.send();
}

function addToCart(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;
      alert(response);
      // showAlert("Success", response, "success");
    }
  };

  request.open("GET", "addToCartProcess.php?id=" + id, true);
  request.send();
}

function changeQTY(id) {
  var qty = document.getElementById("qty_num").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "Updated") {
        showAlert("Success", "Add QTY", "success").then(() => {
          window.location.reload();
        });
      } else {
        showAlert("Error", response, "error");
      }
    }
  };

  request.open(
    "GET",
    "cartQtyUpdateProcess.php?qty=" + qty + "&id=" + id,
    true
  );
  request.send();
}

function deleteFromCart(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "Removed") {
        showAlert("Success", "Product removed from Cart.", "success").then(
          () => {
            window.location.reload();
          }
        );
      } else {
        showAlert("Error", response, "error");
      }
    }
  };

  request.open("GET", "deleteFromCartProcess.php?id=" + id, true);
  request.send();
}

function payNow(id) {
  var qty = document.getElementById("qty_input").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      var obj = JSON.parse(response);

      var mail = obj["umail"];
      var amount = obj["amount"];

      if (response == 1) {
        showAlert("Error", "Please Login.", "error").then(() => {
          window.location = "index.php";
        });
      } else if (response == 2) {
        showAlert("Error", "Please update your profile.", "error").then(() => {
          window.location = "userProfile.php";
        });
      } else {
        // Payment completed. It can be a successful failure.
        payhere.onCompleted = function onCompleted(orderId) {
          console.log("Payment completed. OrderID:" + orderId);

          showAlert(
            "Success",
            "Payment completed. OrderID:" + orderId,
            "success"
          ).then(() => {
            saveInvoice(orderId, id, mail, amount, qty);
          });
          // alert("Payment completed. OrderID:" + orderId);
          // saveInvoice(orderId, id, mail, amount, qty);
        };

        // Payment window closed
        payhere.onDismissed = function onDismissed() {
          // Note: Prompt user to pay again or show an error page
          console.log("Payment dismissed");
        };

        // Error occurred
        payhere.onError = function onError(error) {
          // Note: show an error page
          console.log("Error:" + error);
        };

        // Put the payment variables here
        var payment = {
          sandbox: true,
          merchant_id: obj["mid"], // Replace your Merchant ID
          return_url: "http://localhost/eshop/singleProductView.php?id=" + id, // Important
          cancel_url: "http://localhost/eshop/singleProductView.php?id=" + id, // Important
          notify_url: "http://sample.com/notify",
          order_id: obj["id"],
          items: obj["item"],
          amount: amount + ".00",
          currency: "LKR",
          hash: obj["hash"], // *Replace with generated hash retrieved from backend
          first_name: obj["fname"],
          last_name: obj["lname"],
          email: mail,
          phone: obj["mobile"],
          address: obj["address"],
          city: obj["city"],
          country: "Sri Lanka",
          delivery_address: obj["address"],
          delivery_city: obj["city"],
          delivery_country: "Sri Lanka",
          custom_1: "",
          custom_2: "",
        };

        // Show the payhere.js popup, when "PayHere Pay" is clicked
        // document.getElementById('payhere-payment').onclick = function (e) {
        payhere.startPayment(payment);
        // };
      }
    }
  };

  request.open("GET", "buyNowProcess.php?id=" + id + "&qty=" + qty, true);
  request.send();
}

function saveInvoice(orderId, id, mail, amount, qty) {
  var form = new FormData();
  form.append("o", orderId);
  form.append("i", id);
  form.append("m", mail);
  form.append("a", amount);
  form.append("q", qty);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;

      if (response == "success") {
        window.location = "invoice.php?id=" + orderId;
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "saveInvoiceProcess.php", true);
  request.send(form);
}

function printInvoice() {
  var restorePage = document.body.innerHTML; //body aria content
  var page = document.getElementById("page").innerHTML; //page aria content
  document.body.innerHTML = page;

  window.print();
  document.body.innerHTML = restorePage;
}

var m;
function addFeedback(id) {
  var feedbackModal = document.getElementById("feedbackmodal" + id);
  m = new bootstrap.Modal(feedbackModal);
  m.show();
}

function saveFeedback(id) {
  var type;

  if (document.getElementById("type1").checked) {
    type = 1;
  } else if (document.getElementById("type2").checked) {
    type = 2;
  } else if (document.getElementById("type3").checked) {
    type = 3;
  }

  var feedback = document.getElementById("feed");

  var form = new FormData();
  form.append("pid", id);
  form.append("t", type);
  form.append("f", feedback.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "success") {
        showAlert("Success", "Feedback saved.", "success");
        // alert("Feedback saved.");
        m.hide();
      } else {
        showAlert("Error", response, "error");
      }
    }
  };

  request.open("POST", "saveFeedbackProcess.php", true);
  request.send(form);
}

function deleteFeedback(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "Removed") {
        showAlert(
          "Success",
          "Product Delete From Purchasing History.",
          "success"
        ).then(() => {
          window.location.reload();
        });
      } else {
        showAlert("Error", response, "error");
      }
    }
  };

  request.open("GET", "deleteFromFeedbackProcess.php?id=" + id, true);
  request.send();
}

function deleteAllFeedback(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "Removed") {
        showAlert(
          "Success",
          "All Product Delete From Purchasing History.",
          "success"
        ).then(() => {
          window.location.reload();
        });
        // alert("All Product Delete From Purchasing History.");
        // window.location.reload();
      } else {
        showAlert("Error", response, "error");
      }
    }
  };

  request.open("GET", "deleteAllFromFeedbackProcess.php?id=" + id, true);
  request.send();
}

function bCustomer() {
  window.location = "index.php";
}

var av;

function adminVerification() {
  var email = document.getElementById("e");

  var form = new FormData();
  form.append("e", email.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;
      if (response == "Success") {
        showAlert(
          "Success",
          "Please take a look chat at your email to find the VERIFICATION CODE.",
          "success"
        );
        var adminVerificationModel =
          document.getElementById("verificationModel");
        av = new bootstrap.Modal(adminVerificationModel);
        av.show();
      } else {
        showAlert("Error", response, "error");
      }
    }
  };

  request.open("POST", "adminVerificationProcess.php", true);
  request.send(form);
}

function verify() {
  var code = document.getElementById("vcode");

  var form = new FormData();
  form.append("c", code.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.status == 200 && request.readyState == 4) {
      var response = request.responseText;
      if (response == "success") {
        av.hide();
        window.location = "admindashboard.php";
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "verificationProcess.php", true);
  request.send(form);
}

function blockUser(email) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      // alert(response);
      // window.location.reload();
      showAlert("Success", response, "success").then(() => {
        window.location.reload();
      });
    }
  };

  request.open("GET", "userBlockProcess.php?email=" + email, true);
  request.send();
}

function blockSuppliers(email) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      // alert(response);
      // window.location.reload();
      showAlert("Success", response, "success").then(() => {
        window.location.reload();
      });
    }
  };

  request.open("GET", "suppliersBlockProcess.php?email=" + email, true);
  request.send();
}

var mm;

function viewMsgModal(email) {
  var m = document.getElementById("userMsgModal" + email);
  mm = new bootstrap.Modal(m);
  mm.show();
}

function blockProduct(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      // alert(response);
      // window.location.reload();
      showAlert("Success", response, "success").then(() => {
        window.location.reload();
      });
    }
  };

  request.open("GET", "productBlockProcess.php?id=" + id, true);
  request.send();
}

var pm;

function viewProductModal(id) {
  var m = document.getElementById("viewProductModal" + id);
  pm = new bootstrap.Modal(m);
  pm.show();
}

var cm;

function addNewCategory() {
  var m = document.getElementById("addCategoryModal");
  cm = new bootstrap.Modal(m);
  cm.show();
}

var vc;
var e;
var n;

function verifyCategory() {
  var ncm = document.getElementById("addCategoryVerificationModal");
  var vc = new bootstrap.Modal(ncm);

  e = document.getElementById("em").value;
  n = document.getElementById("nm").value;

  var form = new FormData();
  form.append("email", e);
  form.append("name", n);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "Success") {
        cm.hide();
        vc.show();
      } else {
        alert(response);
      }
    }
  };

  request.open("POST", "addNewCategoryPrcess.php", true);
  request.send(form);
}

function saveCategory() {
  var txt = document.getElementById("txt").value;

  var form = new FormData();
  form.append("t", txt);
  form.append("e", e);
  form.append("n", n);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "success") {
        window.location.reload();
        vc.hide();
      }
      alert(response);
    }
  };

  request.open("POST", "saveCategoryProcess.php", true);
  request.send(form);
}

function contactSubmit() {
  var name = document.getElementById("name");
  var email = document.getElementById("email");
  var mobile = document.getElementById("mobile");
  var prod_name = document.getElementById("prod_name");
  var comment = document.getElementById("comment");

  var form = new FormData();
  form.append("name", name.value);
  form.append("email", email.value);
  form.append("mobile", mobile.value);
  form.append("prod_name", prod_name.value);
  form.append("comment", comment.value);

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "success") {
        showAlert("Success", "Submit Your Commet", "success").then(() => {
          window.location.reload();
        });
      } else {
        showAlert("Error", response, "error");
      }
    }
  };

  request.open("POST", "contact_submit_process.php", true);
  request.send(form);
}

// //sprinner

const spinnerWrapperEl = document.querySelector(".spinner-wrapper");

window.addEventListener("load", () => {
  setTimeout(() => {
    spinnerWrapperEl.style.display = "none";
  }, 1000);
});

function showAlert(title, text, icon) {
  return Swal.fire({
    title: title,
    text: text,
    icon: icon,
    color: "#fff",
  });
}

function search(page) {
  var search = document.getElementById("search");

  var req = new XMLHttpRequest();
  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      var resp = req.responseText;
      document.getElementById("content").innerHTML = resp;
    }
  };

  req.open(
    "GET",
    "searchproductprocess.php?search=" + search.value + "&page=" + page,
    true
  );
  req.send();
}

function filter(page) {
  var category = document.getElementById("category");
  var brand = document.getElementById("brand");
  // var size = document.getElementById("size");
  var color = document.getElementById("color");
  var priceFrom = document.getElementById("priceFrom");
  var priceTo = document.getElementById("priceTo");
  var search = document.getElementById("search");

  var form = new FormData();
  form.append("category", category.value);
  form.append("brand", brand.value);
  // form.append("size", size.value);
  form.append("color", color.value);
  form.append("priceFrom", priceFrom.value);
  form.append("priceTo", priceTo.value);
  form.append("search", search.value);
  form.append("page", page);

  var req = new XMLHttpRequest();
  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      var resp = req.responseText;
      document.getElementById("content").innerHTML = resp;
    }
  };
  req.open("POST", "filterProductProcess.php", true);
  req.send(form);
}

function loadUsers(page) {
  var req = new XMLHttpRequest();
  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      var resp = req.responseText;
      document.getElementById("content").innerHTML = resp;
    }
  };
  req.open("GET", "load-users-process.php?page=" + page, true);
  req.send();
}

function loadProducts(page) {
  var req = new XMLHttpRequest();

  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      var resp = req.responseText;
      document.getElementById("content").innerHTML = resp;
    }
  };

  req.open("GET", "load-products-process.php?page=" + page, true);
  req.send();
}

function loadSuppliers(page) {
  var req = new XMLHttpRequest();

  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      var resp = req.responseText;
      document.getElementById("content").innerHTML = resp;
    }
  };

  req.open("GET", "load-suppliers-process.php?page=" + page, true);
  req.send();
}

function loadCustomer(page) {
  var req = new XMLHttpRequest();

  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 200) {
      var resp = req.responseText;
      document.getElementById("content").innerHTML = resp;
    }
  };

  req.open("GET", "load-customer-process.php?page=" + page, true);
  req.send();
}

function printReport() {
  var Content = document.body.innerHTML;
  var printArea = document.getElementById("printArea");

  document.body.innerHTML = printArea.innerHTML;

  window.print();

  document.body.innerHTML = Content;
}

function registerBrand() {
  var brand = document.getElementById("brandname");

  var form = new FormData();
  form.append("brand", brand.value);

  var req = new XMLHttpRequest();
  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 400) {
      var resp = req.responseText;

      if (resp == "success") {
        window.location.reload();
      }
    }
  };
  req.open("POST", "registerBrandProcess.php", true);
  req.send(form);
}

function registerCategory() {
  var category = document.getElementById("categoryName");

  var form = new FormData();
  form.append("category", category.value);

  var req = new XMLHttpRequest();
  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 400) {
      var resp = req.responseText;
      if (resp == "success") {
        window.location.reload();
      } else {
        alert(resp);
      }
    }
  };
  req.open("POST", "registerCategoryProcess.php", true);
  req.send(form);
}

function registerModel() {
  var category = document.getElementById("modelname");

  var form = new FormData();
  form.append("model", category.value);

  var req = new XMLHttpRequest();
  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 400) {
      var resp = req.responseText;
      if (resp == "success") {
        window.location.reload();
      } else {
        alert(resp);
      }
    }
  };
  req.open("POST", "registerModelProcess.php", true);
  req.send(form);
}

function registerColor() {
  var color = document.getElementById("clrname");

  var form = new FormData();
  form.append("color", color.value);

  var req = new XMLHttpRequest();
  req.onreadystatechange = function () {
    if (req.readyState == 4 && req.status == 400) {
      var resp = req.responseText;
      if (resp == "success") {
        window.location.reload();
      } else {
        alert(resp);
      }
    }
  };
  req.open("POST", "registerColorProcess.php", true);
  req.send(form);
}

function searchInvoice() {
  var txt = document.getElementById("searchtxt").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      document.getElementById("viewArea").innerHTML = response;
    }
  };

  request.open("GET", "searchInvoiceProcess.php?id=" + txt, true);
  request.send();
}

function findsellings() {
  var from = document.getElementById("from").value;
  var to = document.getElementById("to").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      document.getElementById("viewArea").innerHTML = response;
    }
  };

  request.open("GET", "findSellingsProcess.php?f=" + from + "&t=" + to, true);
  request.send();
}

function changeInvoiceStatus(id) {
  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if ((request.status == 200) & (request.readyState == 4)) {
      var response = request.responseText;
      if (response == "success") {
        window.location.reload();
      } else {
        alert(response);
      }
    }
  };

  request.open("GET", "changeInvoiceStatusProcess.php?id=" + id, true);
  request.send();
}

function checkOut() {

  var qty = document.getElementById("qty_num").value;

  var request = new XMLHttpRequest();

  request.onreadystatechange = function () {
      if (request.status == 200 & request.readyState == 4) {
          var response = request.responseText;
          
          // alert(response);
          var obj = JSON.parse(response);

          var mail = obj["umail"];
          var amount = obj["amount"];

          if (response == 2) {
              alert("Please Login.");
              window.location = "index.php";
          } else {

              // Payment completed. It can be a successful failure.
              payhere.onCompleted = function onCompleted(orderId) {
                  console.log("Payment completed. OrderID:" + orderId);

                  // alert("Payment completed. OrderID:" + orderId);
                  // saveInvoice(orderId, mail, amount, qty);

              };

              // Payment window closed
              payhere.onDismissed = function onDismissed() {
                  // Note: Prompt user to pay again or show an error page
                  console.log("Payment dismissed");
              };

              // Error occurred
              payhere.onError = function onError(error) {
                  // Note: show an error page
                  console.log("Error:" + error);
              };

              // Put the payment variables here
              var payment = {
                  "sandbox": true,
                  "merchant_id": obj["mid"],    // Replace your Merchant ID
                  "return_url": "http://localhost/gflow/cart.php",     // Important
                  "cancel_url": "http://localhost/gflow/cart.php",     // Important
                  "notify_url": "http://sample.com/notify",
                  "order_id": obj["id"],
                  "items": obj["item"],
                  "amount": amount + ".00",
                  "currency": "LKR",
                  "hash": obj["hash"], // *Replace with generated hash retrieved from backend
                  "first_name": obj["fname"],
                  "last_name": obj["lname"],
                  "email": mail,
                  "phone": obj["mobile"],
                  "address": obj["address"],
                  "city": obj["city"],
                  "country": "Sri Lanka",
                  "delivery_address": obj["address"],
                  "delivery_city": obj["city"],
                  "delivery_country": "Sri Lanka",
                  "custom_1": "",
                  "custom_2": ""
              };

              // Show the payhere.js popup, when "PayHere Pay" is clicked
              // document.getElementById('payhere-payment').onclick = function (e) {
              payhere.startPayment(payment);
              // };

          }

      }
  }

  request.open("GET", "payment-Process.php?&qty=" + qty, true);
  request.send();
}


